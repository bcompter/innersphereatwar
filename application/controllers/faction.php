<?php

class Faction extends MY_Controller {
    
    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        
        // Make sure the user is signed in
        if ( !$this->ion_auth->logged_in() )
        {
            redirect('auth/login', 'refresh');
        }
    }
    
    /**
     * Create a new faction for a game
     */
    function create($game_id=0)
    {
        $page = $this->page;
        
        $this->load->library('form_validation');
        $this->load->model('gamemodel');
        $this->load->model('factionmodel');
        
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['game'] = $this->gamemodel->get_by_id($game_id);
            $page['content'] = 'faction_form';
            $this->load->view('template', $page);
        }
        else
        {
            // Create the new faction
            $faction = new stdClass();
            $faction->name = $this->input->post('name');
            $faction->color = $this->input->post('color');
            $faction->game_id = $game_id;
            $this->factionmodel->create($faction);
            
            $this->session->set_flashdata('notice', 'Faction created.');
            redirect('faction/view/'.$this->db->insert_id(), 'refresh');
        }
    }
    
    /**
     * Edit a faction
     */
    function edit($faction_id)
    {
        
    }
    
    /**
     * View a faction
     */
    function view($faction_id=0)
    {
        $page = $this->page;
        
        $this->load->model('factionmodel');
        $this->load->model('playermodel');
        $this->load->model('gamemodel');
        $this->load->model('commandmodel');
        
        $page['faction'] = $this->factionmodel->get_by_id($faction_id);
        $page['game'] = $this->gamemodel->get_by_id($page['faction']->game_id);
        $page['players'] = $this->playermodel->get_by_faction($faction_id);
        $page['commands'] = $this->commandmodel->get_by_faction($faction_id);
        
        // Calculate supply requirement
        $mech_supply = $this->db->query('SELECT COUNT(*) AS num FROM formations 
            JOIN combat_commands on combat_commands.command_id=formations.command_id
            WHERE type="Mech" 
            AND combat_commands.faction_id='.$faction_id.'
            AND in_combat=0 AND supply=1')->row()->num*2;
        $mech_supply += $this->db->query('SELECT COUNT(*) AS num FROM formations 
            JOIN combat_commands on combat_commands.command_id=formations.command_id
            WHERE type="Mech" 
            AND combat_commands.faction_id='.$faction_id.'
            AND in_combat=1 AND supply=1')->row()->num*8;
        
        $vee_supply = $this->db->query('SELECT COUNT(*) AS num FROM formations 
            JOIN combat_commands on combat_commands.command_id=formations.command_id
            WHERE type="Vehicle" 
            AND combat_commands.faction_id='.$faction_id.'
            AND in_combat=0 AND supply=1')->row()->num;
        $vee_supply += $this->db->query('SELECT COUNT(*) AS num FROM formations 
            JOIN combat_commands on combat_commands.command_id=formations.command_id
            WHERE type="Vehicle" 
            AND combat_commands.faction_id='.$faction_id.'
            AND in_combat=1 AND supply=1')->row()->num*4;
        
        $aero_supply = $this->db->query('SELECT COUNT(*) AS num FROM formations 
            JOIN combat_commands on combat_commands.command_id=formations.command_id
            WHERE type="Aero" 
            AND combat_commands.faction_id='.$faction_id.'
            AND in_combat=0 AND supply=1')->row()->num;
        $aero_supply += $this->db->query('SELECT COUNT(*) AS num FROM formations 
            JOIN combat_commands on combat_commands.command_id=formations.command_id
            WHERE type="Aero" 
            AND combat_commands.faction_id='.$faction_id.'
            AND in_combat=1 AND supply=1')->row()->num*4;
        
        $inf_supply = $this->db->query('SELECT COUNT(*) AS num FROM formations 
            JOIN combat_commands on combat_commands.command_id=formations.command_id
            WHERE type="Infantry" 
            AND combat_commands.faction_id='.$faction_id.'
            AND in_combat=0 AND supply=1')->row()->num*0.5;
        $inf_supply += $this->db->query('SELECT COUNT(*) AS num FROM formations 
            JOIN combat_commands on combat_commands.command_id=formations.command_id
            WHERE type="Infantry" 
            AND combat_commands.faction_id='.$faction_id.'
            AND in_combat=1 AND supply=1')->row()->num*2;
        $inf_supply = round($inf_supply);
        
        $supply = $mech_supply+$vee_supply+$aero_supply+$inf_supply;
        $page['supply'] = $supply;
        
        // Calculate order cost
        $order_cost = $this->db->query('SELECT SUM(rp_cost) AS sum FROM orders '
                . 'JOIN combat_commands ON combat_commands.command_id=orders.command_id '
                . 'WHERE faction_id='.$faction_id)->row()->sum;
        $page['order_rp_cost'] = $order_cost;
        
        $page['content'] = 'faction_view';
        $this->load->view('template', $page);
    }
    
    /**
     * Join a faction
     */
    function join($faction_id=0)
    {
        $page = $this->page;
        
        $this->load->model('factionmodel');
        $this->load->model('playermodel');
        $this->load->model('gamemodel');
        
        $page['faction'] = $this->factionmodel->get_by_id($faction_id);
        $page['game'] = $this->gamemodel->get_by_id($page['faction']->game_id);
        
        $player = new stdClass();
        $player->user_id = $page['user']->id;
        $player->faction_id = $faction_id;
        $player->game_id = $page['game']->game_id;
        $this->playermodel->create($player);
        
        $this->session->set_flashdata('notice', 'Faction Joined. Welcome to '.$page['faction']->name);
        redirect('faction/view/'.$faction_id, 'refresh');
    }
    
    /**
     * Spend or gain RP
     */
    function modify_rp($faction_id=0)
    {
        $page = $this->page;
        
        $this->load->model('factionmodel');        
        $faction = $this->factionmodel->get_by_id($faction_id);
        
        // Validate form input
        $this->load->library('form_validation');
        $this->form_validation->set_rules('amount', 'Amount', 'required|integer');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['faction'] = $faction;
            $page['content'] = 'faction_modify_rp';
            $this->load->view('template', $page);
        }
        else
        {
            // Adjust RP
            $amount = $this->input->post('amount');
            $faction->rp += $amount;
            $this->factionmodel->update($faction_id, $faction);
            $this->session->set_flashdata('notice', 'RP Adjusted.');
            redirect('faction/view/'.$faction_id, 'refresh');
        }
    }
    
    /**
     * View ranks
     */
    function view_ranks($faction_id=0)
    {
        $page = $this->page;
        
        $this->load->model('factionmodel');        
        $faction = $this->factionmodel->get_by_id($faction_id);
        
        $this->load->model('rankmodel');
        $ranks = $this->rankmodel->get_by_faction($faction_id);
        
        $page['faction'] = $faction;
        $page['ranks'] = $ranks;
        $page['content'] = 'ranks_view';
        $this->load->view('template', $page);
    }
    
    /**
     * Faction private chat system
     * Each faction will have their own chat room to talk strategy
     */
    function chat($faction_id=0)
    {        
        $page = $this->page;
        
        $this->load->model('factionmodel');        
        $faction = $this->factionmodel->get_by_id($faction_id);
        validate_exists($faction->faction_id, 'No such faction.', 'home/dashboard');
        
        // Must be part of this faction to join chat
        $this->load->model('playermodel');
        $player = $this->playermodel->get_by_user_game($page['user']->id, $faction->game_id);
        validate_exists($player->player_id, 'Access Denied...', 'faction/view/'.$faction_id);
        
        $this->load->model('gamemodel');
        $game = $this->gamemodel->get_by_id($faction->game_id);
        
        $page['game'] = $game;
        $page['faction'] = $faction;
        $page['content'] = 'faction_chat';
        $this->load->view('template', $page);
    }
    
    /**
     * Add a chat to the current faction chat
     */
    function chat_new($faction_id=0)
    {        
        $page = $this->page;
        
        $this->load->model('factionmodel');        
        $faction = $this->factionmodel->get_by_id($faction_id);
        validate_exists($faction->faction_id, 'No such faction.', 'home/dashboard');
        
        // Must be part of this faction to join chat
        $this->load->model('playermodel');
        $player = $this->playermodel->get_by_user_game($page['user']->id, $faction->game_id);
        validate_exists($player->player_id, 'Access Denied...', 'faction/view/'.$faction_id);
        
        // Save this message
        $this->load->model('chatmodel');
        $chatMsg = $this->input->post('msg');
        $chatMsg = strip_tags($chatMsg);
        $newMsg = new stdClass();
        $newMsg->msg = $chatMsg;
        $newMsg->player_id = $player->player_id;
        $this->chatmodel->create($newMsg);
        
        $this->load->view('templatexml', $page);
    }
    
    /**
     * Load chat messages
     */
    function chat_load($faction_id=0)
    {        
        $page = $this->page;
        
        $this->load->model('factionmodel');        
        $faction = $this->factionmodel->get_by_id($faction_id);
        validate_exists($faction->faction_id, 'No such faction.', 'home/dashboard');
        
        // Must be part of this faction to join chat
        $this->load->model('playermodel');
        $player = $this->playermodel->get_by_user_game($page['user']->id, $faction->game_id);
        validate_exists($player->player_id, 'Access Denied...', 'faction/view/'.$faction_id);
        
        $this->load->model('chatmodel');
        $page['chats'] = $this->chatmodel->get_last($faction_id);
        
        $this->load->view('chat_load', $page);
    }
    
    /**
     * Update chat
     */
    function chat_update($faction_id=0)
    {        
        $page = $this->page;
        
        $this->load->model('factionmodel');        
        $faction = $this->factionmodel->get_by_id($faction_id);
        validate_exists($faction->faction_id, 'No such faction.', 'home/dashboard');
        
        // Must be part of this faction to join chat
        $this->load->model('playermodel');
        $player = $this->playermodel->get_by_user_game($page['user']->id, $faction->game_id);
        validate_exists($player->player_id, 'Access Denied...', 'faction/view/'.$faction_id);
        
        $time = $this->input->post('chattime');
        
        $this->load->model('chatmodel');
        $page['chats'] = $this->chatmodel->get_new($faction_id, $time);
        
        $this->load->view('chatupdate', $page);
    }
    
}  // end Faction

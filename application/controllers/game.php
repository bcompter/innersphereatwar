<?php

class Game extends MY_Controller {
    
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
     * Create a new game
     */
    function create()
    {
        $page = $this->page;
        
        $this->load->library('form_validation');
        $this->load->model('gamemodel');
        
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['content'] = 'game_form';
            $this->load->view('template', $page);
        }
        else
        {
            // Create the new game
            $game = new stdClass();
            $game->name = $this->input->post('name');
            $this->gamemodel->create($game);
            
            $this->session->set_flashdata('notice', 'Game created.');
            redirect('game/view/'.$this->db->insert_id(), 'refresh');
        }
    }
    
    /**
     * View a game
     */
    function view($game_id=0)
    {
        $page = $this->page;
        
        $this->load->model('gamemodel');
        $this->load->model('factionmodel');
        $page['game'] = $this->gamemodel->get_by_id($game_id);
        $page['factions'] = $this->factionmodel->get_by_game($game_id);
        
        // Game must exist
        validate_exists($page['game']->game_id, 'No such game.', 'home/dashboard');
        
        $page['content'] = 'game_view';
        $this->load->view('template', $page);
    }
    
    /**
     * View all games on the server
     */
    function view_all()
    {
        $page = $this->page;
        
        $this->load->model('gamemodel');
        $page['games'] = $this->gamemodel->get_all();
        $page['content'] = 'game_view_list';
        $this->load->view('template', $page);
    }
    
    /**
     * Pick a faction and play a game
     */
    function play($game_id=0, $faction_id=0)
    {
        $page = $this->page;
        
        $this->load->model('gamemodel');
        $game = $this->gamemodel->get_by_id($game_id);
    }
    
    /**
     * Bank RP points
     */
    function bank_rp($game_id=0)
    {
        $page = $this->page;
        
        $this->load->model('gamemodel');
        $page['game'] = $this->gamemodel->get_by_id($game_id);
        
        validate_exists($page['game']->game_id, 'No such game.', 0, 'templatexml');
        
        // Get interest rate from game settings
        // ... todo ...
        $interest_rate = 0.05;
        
        // Calculate new RP for each faction
        $this->load->model('factionmodel');
        $factions = $this->factionmodel->get_by_game($game_id);
        foreach($factions as $f)
        {
            $interest = $f->rp * $interest_rate;
            log_message('error', $f->name.' earned '.$interest.' RP in interest.');
            $fup = new stdClass();
            $fup->rp = $f->rp + $interest;
            $this->factionmodel->update($f->faction_id, $fup);
        }
        
        // Update game phase
        $gameupdate = new stdClass();
        $gameupdate->phase = 'calc_rp';
        $this->gamemodel->update($game_id, $gameupdate);
        
        $this->session->set_flashdata('notice', 'Resource Points Banked');
        redirect ('game/resolution/'.$game_id, 'refresh');
    }
    
    /**
     * Calculate RP points
     */
    function calc_rp($game_id=0)
    {
        $page = $this->page;
        
        $this->load->model('gamemodel');
        $page['game'] = $this->gamemodel->get_by_id($game_id);
        
        validate_exists($page['game']->game_id, 'No such game.', 0, 'templatexml');
   
        // Calculate RP for each faction
        $this->load->model('factionmodel');
        $factions = $this->factionmodel->get_by_game($game_id);
        foreach($factions as $f)
        {
            $rp = 0;
            log_message('error', $f->name.' earned '.$rp.' RP');
            $fup = new stdClass();
            $fup->rp = $f->rp + $rp;
            $this->factionmodel->update($f->faction_id, $fup);
        }
        
        // Update game phase
        $gameupdate = new stdClass();
        $gameupdate->phase = 'order_writing';
        $this->gamemodel->update($game_id, $gameupdate);
        
        $this->session->set_flashdata('notice', 'Resource Points Calculated');
        redirect ('game/resolution/'.$game_id, 'refresh');
    }
    
    /**
     * View a game resolution dashboard
     */
    function resolution($game_id=0)
    {
        log_message('error', 'resolution of '.$game_id);
        $page = $this->page;
        
        $this->load->model('gamemodel');
        $this->load->model('factionmodel');
        $page['game'] = $this->gamemodel->get_by_id($game_id);
        $page['factions'] = $this->factionmodel->get_by_game($game_id);
        
        // Game must exist
        validate_exists($page['game']->game_id, 'No such game.', 'home/dashboard');
        
        $page['content'] = 'game_resolution';
        $this->load->view('template', $page);
    }
    
    /**
     * Update the game turn
     */
    function update_turn($game_id=0, $value=0)
    {
        $page = $this->page;
        
        $this->load->model('gamemodel');
        $page['game'] = $this->gamemodel->get_by_id($game_id);
        
        validate_exists($page['game']->game_id, 'No such game.', 0, 'templatexml');
                
        // Away we go
        $page['game']->turn += $value;
        $this->gamemodel->update($game_id, $page['game']);
        
        $this->session->set_flashdata('notice', 'Game updated.');
        redirect('game/view/'.$game_id, 'refresh');
    }
    
}

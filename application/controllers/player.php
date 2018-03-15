<?php

class Player extends MY_Controller {
    
    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * View a player
     */
    function view($player_id=0)
    {
        validate_not_match($player_id, 0, 'No such player.', 'home/dashboard');
        
        // Player must exist
        $this->load->model('playermodel');
        $player = $this->playermodel->get_by_id($player_id);
        validate_exists($player->player_id, 'No such player.', 'home/dashboard');
        
        $this->load->model('factionmodel');
        $faction = $this->factionmodel->get_by_id($player->faction_id);
        
        $this->load->model('rankmodel');
        $rank = $this->rankmodel->get_by_id($player->rank);
        
        
        $page['commmands']  = null;
        $page['rank']       = $rank;
        $page['faction']    = $faction;
        $page['player']     = $player;
        $page['content']    = 'player_view';
        $this->load->view('template', $page);
    }
    
    /**
     * Edit this player's character name
     */
    function edit_name($player_id=0)
    {
        $page = $this->page;
        
        // Player must exist
        $this->load->model('playermodel');
        $player = $this->playermodel->get_by_id($player_id);
        validate_exists($player->player_id, 'No such player.', 'home/dashboard');
        
        // Player must be owned by the currently logged in user
        validate_matches($player->user_id, $page['user']->id, 'You don\'t own that ' , 'home/dashboard');
        
        // Validate form
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['player'] = $player;
            $page['content'] = 'player_edit_name_form';
            $this->load->view('template', $page);
        }
        else
        {            
            // Update the player
            $playerupdate = new stdClass();
            $playerupdate->name = $this->input->post('name');
            $this->playermodel->update($player_id, $playerupdate);
  
            $this->session->set_flashdata('notice', 'Player Name Updated.');
            redirect('player/view/'.$player_id, 'refresh');
        }      
    }
    
    /**
     * View all players in a game
     */
    function view_game($game_id=0)
    {
        $page = $this->page;
        
        $this->load->model('gamemodel');
        $game = $this->gamemodel->get_by_id($game_id);
        
        $this->load->model('playermodel');
        $players = $this->playermodel->get_by_game($game_id);
        
        $page['game'] = $game;
        $page['players'] = $players;
        $page['content'] = 'player_view_list';
        $this->load->view('template', $page);
    }
    
    /**
     * View all players in a faction
     */
    function view_faction($faction_id=0)
    {
        $page = $this->page;
        
        $this->load->model('factionmodel');
        $faction = $this->factionmodel->get_by_id($faction_id);
        
        $this->load->model('gamemodel');
        $game = $this->gamemodel->get_by_id($faction->game_id);
        
        $this->load->model('playermodel');
        $players = $this->playermodel->get_by_faction($faction_id);
        
        $page['faction'] = $faction;
        $page['game'] = $game;
        $page['players'] = $players;
        $page['content'] = 'player_view_list';
        $this->load->view('template', $page);
    }
    
    /**
     * Delete a player
     */
    function delete($player_id=0)
    {
        $page = $this->page;
        
        $this->load->model('playermodel');
        $player = $this->playermodel->get_by_id($player_id);
        $this->playermodel->delete($player_id);
        
        $this->session->set_flashdata('notice', 'Player deleted.');
        redirect('player/view_game/'.$player->game_id, 'refresh');
    }
    
}  // end Player

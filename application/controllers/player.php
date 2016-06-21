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
        validate_not_match($player_id, 'No such player.', 'home/dashboard');
        
        $this->load->model('playermodel');
        $player = $this->playermodel->get_by_id($player_id);
        validate_exists($player->player_id, 'No such player.', 'home/dashboard');
        
        $page['player'] = $player;
        $page['content'] = 'player_view';
        $this->load->view('template', $page);
    }
    
}  // end Player

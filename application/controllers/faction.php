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
    function view()
    {
        
    }
    
}

<?php

class Command extends MY_Controller {
    
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
     * Create a new combat command
     */
    function create($game_id=0)
    {
        
    }
    
    /**
     * Delete a combat command
     */
    function delete($command_id=0)
    {
        
    }
    
}

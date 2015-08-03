<?php

class Token extends MY_Controller {
    
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
     * Create a new token
     */
    function create($planet_id=0)
    {
        
    }
    
    /**
     * Remove a token
     */
    function remove($token_id=0)
    {
        
    }
    
    /**
     * Update a tokens position and status
     */
    function update($token_id=0, $x=0, $y=0, $state=0)
    {
        
    }
    
}

<?php

class Rat extends MY_Controller {
    
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
     * View a RAT
     */
    function view()
    {
        
    }
    
    /**
     * View all RATs on the server
     */
    function view_all()
    {
        
    }
    
    /**
     * Create a new RAT table
     */
    function create()
    {
        
    }
    
    /**
     * Edit an existing RAT table
     */
    function edit()
    {
        
    }
    
    /**
     * Add a unit to this RAT
     */
    function add_unit()
    {
        
    }
    
    /**
     * Delete a unit from this RAT
     */
    function delete_unit()
    {
        
    }

}

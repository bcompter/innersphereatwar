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
    function view($rat_id=0)
    {
        
    }
    
    /**
     * View all RATs on the server
     */
    function view_all()
    {
        $page = $this->page;
        
        $this->load->model('ratmodel');
        $page['rats'] = $this->ratmodel->get_all();
        $page['content'] = 'rat_view_list';
        $this->load->view('template', $page);
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
    function edit($rat_id=0)
    {
        
    }
    
    /**
     * Add a unit to this RAT
     */
    function add_unit($rat_id=0, $element_id=0)
    {
        
    }
    
    /**
     * Remove a unit from this RAT
     */
    function remove_unit($rat_id=0, $data_id)
    {
        
    }

}

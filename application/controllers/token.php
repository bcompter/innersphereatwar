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
     * Update a tokens position
     */
    function update_position($token_id=0)
    {
        $page = $this->page;
        
        $this->load->model('tokenmodel');
        $token = $this->tokenmodel->get_by_id($token_id);
        $token->x = $this->input->post('x');
        $token->y = $this->input->post('y');
        $this->tokenmodel->update($token_id, $token);

    }
    
}

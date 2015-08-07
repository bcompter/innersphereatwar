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
    
    /**
     * View a token
     */
    function view($token_id)
    {
        $page = $this->page;
        
        $this->load->model('tokenmodel');
        $this->load->model('formationmodel');
        $this->load->model('commandmodel');
        $this->load->model('combatunitmodel');
        $page['token'] = $this->tokenmodel->get_by_id($token_id);
        $page['formation'] = $this->formationmodel->get_by_id($page['token']->formation_id);
        $page['command'] = $this->commandmodel->get_by_id($page['formation']->command_id);
        $page['combatunits'] = $this->combatunitmodel->get_by_formation($page['formation']->formation_id);
        $page['content'] = 'token_view_detail';
        $this->load->view('templatexml', $page);
    }
    
}

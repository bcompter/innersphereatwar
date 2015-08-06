<?php

class Formation extends MY_Controller {
    
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
     * Delete a formation
     */
    function delete($formation_id=0)
    {
        $page = $this->page;
        $this->load->model('formationmodel');
        $this->load->model('commandmodel');
        
        $formation = $this->formationmodel->get_by_id($formation_id);
        $command = $this->commandmodel->get_by_id($formation->command_id);
        
        $this->formationmodel->delete($formation_id);
        
        $this->session->set_flashdata('notice', 'Formation deleted.');
        redirect('command/view/'.$command->command_id, 'refresh');
    }
    
    /**
     * View a formation
     */
    function view($formation_id=0)
    {
        $page = $this->page;
        $this->load->model('formationmodel');
        $this->load->model('commandmodel');
        $this->load->model('combatunitmodel');
        
        $page['formation'] = $this->formationmodel->get_by_id($formation_id);
        $page['command'] = $this->commandmodel->get_by_id($page['formation']->command_id);
        $page['combatunits'] = $this->combatunitmodel->get_by_formation($formation_id);
        $page['content'] = 'formation_view';
        $this->load->view('template', $page);
    }
    
    /**
     * Add a new combat unit to this formation
     */
    function add_combatunit($formation_id=0)
    {
        $page = $this->page;
        $this->load->model('formationmodel');
        $this->load->model('combatunitmodel');
        
        $formation = $this->formationmodel->get_by_id($formation_id);
        
        $this->load->library('form_validation');
        
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['formation'] = $formation;
            $page['content'] = 'combatunit_form';
            $this->load->view('template', $page);
        }
        else
        {            
            // Create the new formation
            $combatunit = new stdClass();
            $combatunit->name = $this->input->post('name');
            $combatunit->formation_id = $formation_id;
            $this->combatunitmodel->create($combatunit);
            
            $this->session->set_flashdata('notice', 'Combat Unit created.');
            redirect('combatunit/view/'.$this->db->insert_id(), 'refresh');
        }
    }
}

<?php

class Combatunit extends MY_Controller {
    
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
     * View a combat unit
     */
    function view($combatunit_id=0)
    {
        $page = $this->page;
        $this->load->model('combatunitmodel');
        $this->load->model('formationmodel');
        $this->load->model('combatteammodel');
        $page['combatunit'] = $this->combatunitmodel->get_by_id($combatunit_id);
        $page['formation'] = $this->formationmodel->get_by_id($page['combatunit']->formation_id);
        $page['combatteams'] = $this->combatteammodel->get_by_combatunit($combatunit_id);
        $page['content'] = 'combatunit_view';
        $this->load->view('template', $page);
    }
    
    /**
     * Delete this combat unit
     */
    function delete($combatunit_id=0)
    {
        $page = $this->page;
        $this->load->model('combatunitmodel');
        $this->load->model('formationmodel');
        $combatunit = $this->combatunitmodel->get_by_id($combatunit_id);
        $formation = $this->formationmodel->get_by_id($combatunit->formation_id);
        
        $this->combatunitmodel->delete($combatunit_id);
        
        $this->session->set_flashdata('notice', 'Combat Unit deleted.');
        redirect('formation/view/'.$formation->formation_id, 'refresh');
    }
    
    /**
     * Add a combat team
     */
    function add_combatteam($combatunit_id=0)
    {
        $page = $this->page;
        $this->load->model('combatteammodel');
        $this->load->model('combatunitmodel');
        
        $combatunit = $this->combatunitmodel->get_by_id($combatunit_id);
        
        $this->load->library('form_validation');
        
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['combatunit'] = $combatunit;
            $page['content'] = 'combatteam_form';
            $this->load->view('template', $page);
        }
        else
        {            
            // Create the new combat team
            $combatteam = new stdClass();
            $combatteam->name = $this->input->post('name');
            $combatteam->combatunit_id = $combatunit_id;
            $this->combatteammodel->create($combatteam);
            
            $this->session->set_flashdata('notice', 'Combat Team created.');
            redirect('combatteam/view/'.$this->db->insert_id(), 'refresh');
        }
    }
    
}
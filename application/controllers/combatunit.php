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
        $page['combatunit'] = $this->combatunitmodel->get_by_id($combatunit_id);
        $page['formation'] = $this->formationmodel->get_by_id($page['combatunit']->formation_id);
        
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
        
    }
    
}

<?php

class Combatteam extends MY_Controller {
    
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
     * Create a new combat team from stats
     */
    function create($combatunit_id=0)
    {
        $page = $this->page;
    }
    
    /**
     * Randomly generate a combat team from a RAT table
     */
    function generate($combatunit_id=0)
    {
        $page = $this->page;
        
        $this->load->model('formationmodel');
        $this->load->model('combatunitmodel');
        $this->load->model('combatteammodel');
        $this->load->model('lancemodel');
        $this->load->model('unitmodel');
        $this->load->model('ratmodel');
        $this->load->model('ratdatamodel');
        
        $combatteam = new stdClass();
        
        // Generate three lances
        for ($l = 0; $l < 3; $l++)
        {
            $lance = new stdClass();
            // Generate four Elements per lance
            for ($e = 0; $e < 4; $e++)
            {
                
            }
            $this->lancemodel->create($lance);
            
        }  // end for l
        
        $this->combatteammodel->create($combatteam);
        $this->session->set_flashdata('notice', 'Combat team generated.');
        redirect('combatunit/view/'.$combatunit_id, 'refresh');
    }
    
    /**
     * Delete a combat team
     */
    function delete($combatteam_id=0)
    {
        $page = $this->page;
        
        $this->load->model('combatteammodel');
        $this->load->model('combatunitmodel');
        $combatteam = $this->combatteammodel->get_by_id($combatteam_id);
        $combatunit = $this->combatunitmodel->get_by_id($combatteam->combatunit_id);
        
        $this->combatteammodel->delete($combatteam_id);
        
        $this->session->set_flashdata('notice', 'Combat team deleted.');
        redirect('combatunit/view/'.$combatunit->combatunit_id, 'refresh');
    }
    
    /**
     * View this combatteam
     */
    function view($combatteam_id=0)
    {
        $page = $this->page;
    }
}

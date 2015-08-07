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
     * Create a new combat team from given data
     */
    function create($combatunit_id=0)
    {
        $page = $this->page;
    }
    
    /**
     * Randomly generate a combat team from a RAT table
     * The RAT table is inherited from the parent formation
     */
    function generate($combatteam_id=0)
    {
        generate_combatteam($combatteam_id);
        
        $this->session->set_flashdata('notice', 'Combat team generated.');
        redirect('combatteam/view/'.$combatteam_id, 'refresh');
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
        
        $this->load->model('combatteammodel');
        $this->load->model('combatunitmodel');
        $this->load->model('lancemodel');
        $this->load->model('elementmodel');
        $page['combatteam'] = $this->combatteammodel->get_by_id($combatteam_id);
        $page['combatunit'] = $this->combatunitmodel->get_by_id($page['combatteam']->combatunit_id);
        $page['lances'] = $this->lancemodel->get_by_combatteam($combatteam_id);
        foreach($page['lances'] as $l)
        {
            $page['elements'][] = $this->elementmodel->get_by_lance($l->lance_id);
        }
        $page['content'] = 'combatteam_view';
        
        $this->load->view('template', $page);
    }
    
    /**
     * Zero out all data for this combat team
     */
    function clear($combatteam_id)
    {
        $page = $this->page;
        
        $this->load->model('combatteammodel');
        $combatteam = $this->combatteammodel->get_by_id($combatteam_id);
        $combatteam->move = 0;
        $combatteam->tmm = 0;
        $combatteam->armor = 0;
        $combatteam->short_dmg = 0;
        $combatteam->med_dmg = 0;
        $combatteam->long_dmg = 0;
        $this->combatteammodel->update($combatteam_id, $combatteam);
        $this->session->set_flashdata('notice', 'Combat team cleared.');
        redirect('combatteam/view/'.$combatteam_id, 'refresh');
    }
}

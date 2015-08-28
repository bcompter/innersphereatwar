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
    
    /**
     * Damage this combatunit
     */
    function damage($combatunit_id=0)
    {
        $page = $this->page;
        $this->load->model('combatunitmodel');
        $this->load->model('formationmodel');
        $this->load->model('commandmodel');
        $this->load->model('planetmodel');
        $combatunit = $this->combatunitmodel->get_by_id($combatunit_id);
        $formation = $this->formationmodel->get_by_id($combatunit->formation_id);
        $command = $this->commandmodel->get_by_id($formation->command_id);
        $planet = $this->planetmodel->get_by_id($command->planet_id);
        $this->load->library('form_validation');
        
        // Validate form input
        $this->form_validation->set_rules('damage', 'Damage', 'required|integer');
        if ($this->form_validation->run() == FALSE)
        {
            // Show the form
            $page['combatunit'] = $combatunit;
            $page['formation'] = $formation;
            $page['content'] = 'combatunit_damage';
            $this->load->view('template', $page);
        }
        else
        {
            // Damage the unit and return to the view
            $damage = $this->input->post('damage');
            if ($damage > $combatunit->armor - $combatunit->damage)
            {
                $damage = $combatunit->armor - $combatunit->damage;
            }
            $combatunit->damage += $damage;
            $this->combatunitmodel->update($combatunit_id, $combatunit);
            
            if ($damage > 0 && isset($planet->planet_id))
            {
                // Add this damage to the damage pool
                $planet->salvage_pool += $damage;
                $this->planetmodel->update($planet->planet_id, $planet);
            }
            
            $this->session->set_flashdata('notice', 'Damage applied!');
            redirect('formation/view/'.$formation->formation_id, 'refresh');
        }
    }
    
    /**
     * Calculate stats for a combatunit
     */
    function calculate($combatunit_id=0)
    {
        calculate_combatunit($combatunit_id);
        $this->session->set_flashdata('notice', 'Calculated.');
        redirect('combatunit/view/'.$combatunit_id, 'refresh');
    }
    
}
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
            $combatunit->move = $this->input->post('move');
            $combatunit->size = $this->input->post('size');
            $combatunit->tmm = $this->input->post('tmm');
            
            $combatunit->armor = $this->input->post('arm');
            $combatunit->short_dmg = $this->input->post('short_dmg');
            $combatunit->med_dmg = $this->input->post('med_dmg');
            $combatunit->long_dmg = $this->input->post('long_dmg');
            
            $combatunit->tactics = $this->input->post('tactics');
            $combatunit->morale = $this->input->post('morale');
            
            $combatunit->formation_id = $formation_id;
            $this->combatunitmodel->create($combatunit);
            
            $this->session->set_flashdata('notice', 'Combat Unit created.');
            redirect('combatunit/view/'.$this->db->insert_id(), 'refresh');
        }
    }
    
    /**
     * Place a token for this unit in that units current planet
     */
    function place_token($formation_id=0, $location=0)
    {
        $page = $this->page;
        
        $this->load->model('tokenmodel');
        $this->load->model('formationmodel');
        $this->load->model('commandmodel');
        $formation = $this->formationmodel->get_by_id($formation_id);
        $command = $this->commandmodel->get_by_id($formation->command_id);
        $token = new stdClass();
        $token->formation_id = $formation_id;
        $token->planet_id = $command->planet_id;
        $token->location = $location;
        $this->tokenmodel->create($token);
      
        $this->session->set_flashdata('notice', 'Token placed.');
        redirect('command/view/'.$command->command_id, 'refresh');
    }
    
    /**
     * Remove this formations tokens
     */
    function remove_token($formation_id=0)
    {
        $page = $this->page;
        
        $this->load->model('tokenmodel');
        $this->load->model('formationmodel');
        $this->load->model('commandmodel');
        $formation = $this->formationmodel->get_by_id($formation_id);
        $command = $this->commandmodel->get_by_id($formation->command_id);
        $this->tokenmodel->delete_by_formation($formation_id);
      
        $this->session->set_flashdata('notice', 'Token removed.');
        redirect('command/view/'.$command->command_id, 'refresh');
    }
    
    /**
     * Generate this formation using RAT tables
     */
    function generate($formation_id=0)
    {
        generate_formation($formation_id);
        $this->session->set_flashdata('notice', 'Formation generated.');
        redirect('formation/view/'.$formation_id, 'refresh');
    }
    
    /**
     * Recalculate this formations stats
     */
    function calculate($formation_id=0)
    {
        calculate_formation($formation_id);
        $this->session->set_flashdata('notice', 'Formation stats calculated.');
        redirect('formation/view/'.$formation_id, 'refresh');
    }
    
    /**
     * Edit this formations name
     */
    function edit_name($formation_id=0)
    {
        $page = $this->page;
        
        $this->load->library('form_validation');
        $this->load->model('formationmodel');
        $this->load->model('commandmodel');
        $page['formation'] = $this->formationmodel->get_by_id($formation_id);
        $command = $this->commandmodel->get_by_id($page['formation']->command_id);
        
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['content'] = 'formation_form_name';
            $this->load->view('template', $page);
        }
        else
        {            
            // Create the new formation
            $formation = new stdClass();
            $formation->name = $this->input->post('name');
            $this->formationmodel->update($formation_id, $formation);
            
            $this->session->set_flashdata('notice', 'Formation name updated.');
            redirect('command/view/'.$command->command_id, 'refresh');
        }
    }
}

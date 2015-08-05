<?php

class Command extends MY_Controller {
    
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
     * Create a new combat command
     */
    function create($faction_id=0)
    {
        $page = $this->page;
        
        $this->load->library('form_validation');
        $this->load->model('gamemodel');
        $this->load->model('factionmodel');
        $this->load->model('commandmodel');
        
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['faction'] = $this->factionmodel->get_by_id($faction_id);
            $page['content'] = 'command_form';
            $this->load->view('template', $page);
        }
        else
        {            
            // Create the new faction
            $page['faction'] = $this->factionmodel->get_by_id($faction_id);
            $game = $this->gamemodel->get_by_id($page['faction']->game_id);
            $command = new stdClass();
            $command->name = $this->input->post('name');
            $command->game_id = $game->game_id;
            $command->faction_id = $faction_id;
            $command->experience = $this->input->post('experience');
            $command->loyalty = $this->input->post('loyalty');
            $this->commandmodel->create($command);
            
            $this->session->set_flashdata('notice', 'Command created.');
            redirect('command/view/'.$this->db->insert_id(), 'refresh');
        }
    }
    
    /**
     * Delete a combat command
     */
    function delete($command_id=0)
    {
        
    }
    
    /**
     * View a combat command
     */
    function view($command_id)
    {
        $page = $this->page;
        
        $this->load->model('commandmodel');
        $this->load->model('factionmodel');
        $this->load->model('gamemodel');
        
        $page['command'] = $this->commandmodel->get_by_id($command_id);
        $page['faction'] = $this->factionmodel->get_by_id($page['command']->faction_id);
        $page['game'] = $this->gamemodel->get_by_id($page['faction']->game_id);
        $page['content'] = 'command_view';
        $this->load->view('template', $page);
    }
    
}

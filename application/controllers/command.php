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
            // Create the new command
            $page['faction'] = $this->factionmodel->get_by_id($faction_id);
            $game = $this->gamemodel->get_by_id($page['faction']->game_id);
            $command = new stdClass();
            $command->name = $this->input->post('name');
            $command->game_id = $game->game_id;
            $command->faction_id = $faction_id;
            $command->experience = $this->input->post('experience');
            $command->loyalty = $this->input->post('loyalty');
            $command->tech = $this->input->post('tech');
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
        $page = $this->page;
        $this->load->model('commandmodel');
        $this->load->model('factionmodel');
        $page['command'] = $this->commandmodel->get_by_id($command_id);
        $page['faction'] = $this->factionmodel->get_by_id($page['command']->faction_id);
        
        $this->commandmodel->delete($command_id);
        
        $this->session->set_flashdata('notice', 'Command deleted.');
        redirect('faction/view/'.$page['faction']->faction_id, 'refresh');
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
        $this->load->model('planetmodel');
        $this->load->model('formationmodel');
        $this->load->model('ordermodel');
        $this->load->model('playermodel');
        
        $page['command'] = $this->commandmodel->get_by_id($command_id);
        $page['faction'] = $this->factionmodel->get_by_id($page['command']->faction_id);
        $page['game'] = $this->gamemodel->get_by_id($page['faction']->game_id);
        $page['planet'] = $this->planetmodel->get_by_id($page['command']->planet_id);
        $page['formations'] = $this->formationmodel->get_by_command($command_id);
        $page['orders'] = $this->ordermodel->get_by_command($command_id);
        $page['co'] = $this->playermodel->get_by_id($page['command']->co_id);
        $page['content'] = 'command_view';
        $this->load->view('template', $page);
    }
    
    /**
     * Add a formation to this combat command
     */
    function add_formation($command_id=0)
    {
        $page = $this->page;
        
        $this->load->library('form_validation');
        $this->load->model('gamemodel');
        $this->load->model('factionmodel');
        $this->load->model('commandmodel');
        $this->load->model('formationmodel');
        
        $page['command'] = $this->commandmodel->get_by_id($command_id);
        
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['content'] = 'formation_form';
            $this->load->view('template', $page);
        }
        else
        {            
            // Create the new formation
            $formation = new stdClass();
            $formation->name = $this->input->post('name');
            $formation->type = $this->input->post('type');
            $formation->command_id = $command_id;
            $this->formationmodel->create($formation);
            
            $this->session->set_flashdata('notice', 'Formation created.');
            redirect('command/view/'.$command_id, 'refresh');
        }
    }
    
    /**
     * Add a typical mix of 1 Mech, 1 Vee, and 1 aero to this command
     */
    function add_formation_standard($command_id=0)
    {
        $page = $this->page;
        
        $this->load->model('commandmodel');
        $this->load->model('formationmodel');
        
        $page['command'] = $this->commandmodel->get_by_id($command_id);
        
        $formation = new stdClass();
        $formation->name = 'M1';
        $formation->type = 'Mech';
        $formation->command_id = $command_id;
        $this->formationmodel->create($formation);
        
        $formation->name = 'A1';
        $formation->type = 'Aero';
        $formation->command_id = $command_id;
        $this->formationmodel->create($formation);
        
        $formation->name = 'V1';
        $formation->type = 'Vehicle';
        $formation->command_id = $command_id;
        $this->formationmodel->create($formation);
        
        $this->session->set_flashdata('notice', 'Formations created.');
        redirect('command/view/'.$command_id, 'refresh');
    }
    
    /**
     * Add a dropship combat unit to this command
     */
    function add_dropship($command_id=0)
    {
        $page = $this->page;
        
        $this->load->model('commandmodel');
        $this->load->model('formationmodel');
        $this->load->model('combatunitmodel');
        
        $page['command'] = $this->commandmodel->get_by_id($command_id);
        
        $formation = new stdClass();
        $formation->name = 'D1';
        $formation->type = 'Aero';
        $formation->command_id = $command_id;
        $this->formationmodel->create($formation);
        
        $id = $this->db->insert_id();
        unset($formation);
        $formation = $this->formationmodel->get_by_id($id);
        
        $combatunit = new stdClass();
        $combatunit->formation_id = $id;
        $combatunit->name = 'Battalion 1';
        $combatunit->size = 4;
        $combatunit->move = 3;
        $combatunit->tmm = 1;
        $combatunit->armor = 39;
        $combatunit->short_dmg = 9;
        $combatunit->med_dmg = 9;
        $combatunit->long_dmg = 4;
        $combatunit->tactics = 7;
        $combatunit->morale = 10;
        $this->combatunitmodel->create($combatunit);
        
        calculate_formation($id);
        
        $this->session->set_flashdata('notice', 'Dropship Formation created.');
        redirect('command/view/'.$command_id, 'refresh');
    }
    
    /**
     * Move this command to a new planet
     */
    function move($command_id=0, $planet_id=0)
    {
        $page = $this->page;

        $this->load->model('commandmodel');        
        if ($planet_id != 0)
        {
            $command = $this->commandmodel->get_by_id($command_id);
            $command->planet_id = $planet_id;
            $this->commandmodel->update($command_id, $command);
            $this->session->set_flashdata('notice', 'Command Moved!');
            redirect('command/view/'.$command_id, 'refresh');
        }
        else
        {
            $this->load->model('factionmodel');
            $this->load->model('gamemodel');
            $this->load->model('planetmodel');

            $page['command'] = $this->commandmodel->get_by_id($command_id);
            $page['faction'] = $this->factionmodel->get_by_id($page['command']->faction_id);
            $page['game'] = $this->gamemodel->get_by_id($page['faction']->game_id);
            $page['planets'] = $this->planetmodel->get_by_game($page['game']->game_id);
            $page['content'] = 'command_move';
            $this->load->view('template', $page);
        } 
    }
    
    /**
     * Toggle the in combat flag
     */
    function toggle_in_combat($command_id=0)
    {
        $this->load->model('factionmodel');
        $this->load->model('commandmodel');

        $command = $this->commandmodel->get_by_id($command_id);
        $faction = $this->factionmodel->get_by_id($command->faction_id);
        
        $command->in_combat = !$command->in_combat;
        $this->commandmodel->update($command_id, $command);
        
        $this->session->set_flashdata('notice', 'Updated.');
        redirect('faction/view/'.$faction->faction_id, 'refresh');
    }
    
    /**
     * Toggle the in suply flag
     */
    function toggle_in_supply($command_id=0)
    {
        $this->load->model('factionmodel');
        $this->load->model('commandmodel');

        $command = $this->commandmodel->get_by_id($command_id);
        $faction = $this->factionmodel->get_by_id($command->faction_id);
        
        $command->supply = !$command->supply;
        $this->commandmodel->update($command_id, $command);
        
        $this->session->set_flashdata('notice', 'Updated.');
        redirect('faction/view/'.$faction->faction_id, 'refresh');
    }
    
    /**
     * Increment or decrement the fatigue
     */
    function modify_fatigue($command_id=0, $value=0)
    {
        $this->load->model('factionmodel');
        $this->load->model('commandmodel');

        $command = $this->commandmodel->get_by_id($command_id);
        $faction = $this->factionmodel->get_by_id($command->faction_id);
        
        $command->fatigue += $value;
        $this->commandmodel->update($command_id, $command);
        
        $this->session->set_flashdata('notice', 'Updated.');
        redirect('faction/view/'.$faction->faction_id, 'refresh');
    }
}

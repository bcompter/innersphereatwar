<?php

class Planet extends MY_Controller {
    
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
     * Create a new planet
     */
    function create($game_id=0)
    {
        $page = $this->page;
        
        $this->load->library('form_validation');
        $this->load->model('gamemodel');
        $this->load->model('planetmodel');
        
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['game'] = $this->gamemodel->get_by_id($game_id);
            $page['content'] = 'planet_form';
            $this->load->view('template', $page);
        }
        else
        {
            // Create the new planet
            $game = $this->gamemodel->get_by_id($game_id);
            
            $planet = new stdClass();
            $planet->name = $this->input->post('name');
            $planet->game_id = $game_id;
            $planet->type = $this->input->post('type');
            $planet->x = $this->input->post('x');
            $planet->y = $this->input->post('y');
            $this->planetmodel->create($planet);
            
            $this->session->set_flashdata('notice', 'Planet created.');
            redirect('planet/view/'.$this->db->insert_id(), 'refresh');
        }
    }
    
    /**
     * Edit a planet
     */
    function edit()
    {
        
    }
    
    /**
     * View a planet
     */
    function view($planet_id=0)
    {
        $page = $this->page;
        
        $this->load->model('planetmodel');
        $this->load->model('commandmodel');
        $page['planet'] = $this->planetmodel->get_by_id($planet_id);
        $page['commands'] = $this->commandmodel->get_by_planet($planet_id);
        $page['content'] = 'planet_view';
        $this->load->view('template', $page);
    }
    
    /**
     * View this planets aero map 
     */
    function view_aero($planet_id=0)
    {
        $page = $this->page;
        
        $this->load->model('planetmodel');
        $this->load->model('tokenmodel');
        $this->load->model('factionmodel');
        $page['planet'] = $this->planetmodel->get_by_id($planet_id);
        $page['tokens'] = $this->tokenmodel->get_by_planet($planet_id, 'Aero');
        $page['faction'] = $this->factionmodel->get_by_game_user($page['planet']->game_id, $this->page['user']->id);
        $page['content'] = 'planet_view_aero';
        $this->load->view('template', $page);
    }
    
    /**
     * View this planets ground map
     */
    function view_ground($planet_id=0)
    {
        $page = $this->page;
        
        $this->load->model('planetmodel');
        $this->load->model('tokenmodel');
        $this->load->model('factionmodel');
        $page['planet'] = $this->planetmodel->get_by_id($planet_id);
        $page['tokens'] = $this->tokenmodel->get_by_planet($planet_id, 'Ground');
        $page['faction'] = $this->factionmodel->get_by_game_user($page['planet']->game_id, $this->page['user']->id);
        $page['content'] = 'planet_view_ground';
        $this->load->view('template', $page);
    }
    
    /**
     * View all planets in a game
     */
    function view_game($game_id=0)
    {
        $page = $this->page;
        
        $this->load->model('planetmodel');
        $page['planets'] = $this->planetmodel->get_by_game($game_id);
        $this->load->model('gamemodel');
        $page['game'] = $this->gamemodel->get_by_id($game_id);
        $page['content'] = 'planet_view_list';
        $this->load->view('template', $page);
    }
    
}

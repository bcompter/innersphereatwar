<?php

class Game extends MY_Controller {
    
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
     * Create a new game
     */
    function create()
    {
        $page = $this->page;
        
        $this->load->library('form_validation');
        $this->load->model('gamemodel');
        
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['content'] = 'game_form';
            $this->load->view('template', $page);
        }
        else
        {
            // Create the new game
            $game = new stdClass();
            $game->name = $this->input->post('name');
            $this->gamemodel->create($game);
            
            $this->session->set_flashdata('notice', 'Game created.');
            redirect('game/view/'.$this->db->insert_id(), 'refresh');
        }
    }
    
    /**
     * View a game
     */
    function view($game_id=0)
    {
        $page = $this->page;
        
        $this->load->model('gamemodel');
        $page['game'] = $this->gamemodel->get_by_id($game_id);
        $page['content'] = 'game_view';
        $this->load->view('template', $page);
    }
    
    /**
     * View all games on the server
     */
    function view_all()
    {
        $page = $this->page;
        
        $this->load->model('gamemodel');
        $page['games'] = $this->gamemodel->get_all();
        $page['content'] = 'game_view_list';
        $this->load->view('template', $page);
    }
    
    /**
     * Update the game turn
     */
    function update_turn($game_id=0, $value=0)
    {
        $page = $this->page;
        
        $this->load->model('gamemodel');
        $page['game'] = $this->gamemodel->get_by_id($game_id);
        $page['game']->turn += $value;
        $this->gamemodel->update($game_id, $page['game']);
        
        $this->session->set_flashdata('notice', 'Game updated.');
        redirect('game/view/'.$game_id, 'refresh');
    }
    
}

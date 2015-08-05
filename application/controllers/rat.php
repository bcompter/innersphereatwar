<?php

class Rat extends MY_Controller {
    
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
     * View a RAT
     */
    function view($rat_id=0)
    {
        $page = $this->page;
        
        $this->load->model('ratmodel');
        $this->load->model('ratdatamodel');
        $page['rat'] = $this->ratmodel->get_by_id($rat_id);
        $page['ratdata'] = $this->ratdatamodel->get_by_rat($rat_id);
        $page['content'] = 'rat_view';
        $this->load->view('template', $page);
    }
    
    /**
     * View all RATs on the server
     */
    function view_all()
    {
        $page = $this->page;
        
        $this->load->model('ratmodel');
        $page['rats'] = $this->ratmodel->get_all();
        $page['content'] = 'rat_view_list';
        $this->load->view('template', $page);
    }
    
    /**
     * Create a new RAT table
     */
    function create()
    {
        $page = $this->page;
        
        $this->load->library('form_validation');
        $this->load->model('ratmodel');
        
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['content'] = 'rat_form';
            $this->load->view('template', $page);
        }
        else
        {
            // Create the new rat
            $rat = new stdClass();
            $rat->name = $this->input->post('name');
            $rat->faction = $this->input->post('faction');
            $rat->type = $this->input->post('type');
            $rat->size   = $this->input->post('size');
            $this->ratmodel->create($rat);
            
            $this->session->set_flashdata('notice', 'RAT created.');
            redirect('rat/view/'.$this->db->insert_id(), 'refresh');
        }
    }
    
    /**
     * Edit an existing RAT table
     */
    function edit($rat_id=0)
    {
        
    }
    
    /**
     * Add a unit to this RAT
     */
    function add_unit($rat_id=0, $element_id=0)
    {
        
    }
    
    /**
     * Remove a unit from this RAT
     */
    function remove_unit($rat_id=0, $data_id)
    {
        
    }

}

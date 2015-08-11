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
            $rat->tech = $this->input('tech');
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
        $page = $this->page;
        
        $this->load->model('ratmodel');
        $this->load->model('ratdatamodel');
        $this->load->model('unitmodel');
        $page['rat'] = $this->ratmodel->get_by_id($rat_id);
        $page['ratdata'] = $this->ratdatamodel->get_by_rat($rat_id);
        
        if ($element_id == 0)
        {
            // Show the select form
            $page['units'] = $this->unitmodel->get_by_size($page['rat']->size);
            $page['content'] = 'rat_add';
            $this->load->view('template', $page);
            return;
        }
        else
        {
            // Add the requested unit
            $unit = $this->unitmodel->get_by_id($element_id);
            $page['ratdata'] = $this->ratdatamodel->get_by_rat($rat_id);
            
            $rat_data = new stdClass();
            $rat_data->rat_id = $rat_id;
            $rat_data->unit_id = $element_id;
            $rat_data->unit_name = $unit->name;
            $rat_data->roll = count($page['ratdata'])+2;
            $this->ratdatamodel->create($rat_data);
            
            $this->session->set_flashdata('notice', 'Unit added.');
            redirect('rat/view/'.$rat_id, 'refresh');
        }
        
    }
    
    /**
     * Remove a unit from this RAT
     */
    function remove_unit($rat_id=0, $data_id=0)
    {
        $page = $this->page;
        
        $this->load->model('ratdatamodel');
        $this->ratdatamodel->delete($data_id);
        
        $this->session->set_flashdata('notice', 'Unit removed.');
        redirect('rat/view/'.$rat_id, 'refresh');
    }
    
    /**
     * Update a roll value
     */
    function update_data($rat_id=0, $data_id=0, $mod=0)
    {
        $page = $this->page;
        
        $this->load->model('ratmodel');
        $this->load->model('ratdatamodel');
        
        $rat = $this->ratmodel->get_by_id($rat_id);
        $data = $this->ratdatamodel->get_by_id($data_id);
        $data->roll += $mod;
        $this->ratdatamodel->update($data_id, $data);
        
        $this->session->set_flashdata('notice', 'Unit updated.');
        redirect('rat/view/'.$rat_id, 'refresh');
    }

}

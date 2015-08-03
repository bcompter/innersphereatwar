<?php

class Unit extends MY_Controller {
    
    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Create a new unit
     */
    function create()
    {
        $page = $this->page;
        
        $this->load->library('form_validation');
        $this->load->model('unitmodel');
        
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['content'] = 'unit_form';
            $this->load->view('template', $page);
        }
        else
        {
            // Create the new unit
            $unit = new stdClass();
            $unit->name = $this->input->post('name');
            $this->unitmodel->create($unit);
            
            $this->session->set_flashdata('notice', 'Unit created.');
            redirect('unit/view/'.$this->db->insert_id(), 'refresh');
        }
    }

    /**
     * Edit a unit
     */
    function edit($unit_id)
    {
        
    }
    
    /**
     * Delete a unit
     */
    function delete($unit_id=0)
    {
        
    }
    
    /**
     * View a unit
     */
    function view($unit_id=0)
    {
        $page = $this->page;
        
        $this->load->model('unitmodel');
        $page['unit'] = $this->unitmodel->get_by_id($unit_id);
        $page['content'] = 'unit_view';
        $this->load->view('template', $page);
    }
    
    /**
     * View all units in the game
     */
    function view_all()
    {
        $page = $this->page;
        
        $this->load->model('unitmodel');
        $page['units'] = $this->unitmodel->get_all();
        $page['content'] = 'unit_view_list';
        $this->load->view('template', $page);
    }
}

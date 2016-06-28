<?php

class Ranks extends MY_Controller {
    
    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Create a new rank for a faction
     */
    function create($faction_id=0)
    {
        $page = $this->page;
        
        $this->load->library('form_validation');
        $this->load->model('rankmodel');
        
        $this->load->model('factionmodel');        
        $faction = $this->factionmodel->get_by_id($faction_id);
        
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
        if ($this->form_validation->run() == FALSE)
        { 
            // Show the form
            $page['faction'] = $this->factionmodel->get_by_id($faction_id);
            $page['content'] = 'rank_form';
            $this->load->view('template', $page);
        }
        else
        {
            // Create the new rank
            $rank = new stdClass();
            $rank->text = $this->input->post('name');
            $rank->order_num = $this->input->post('order_num');
            $rank->faction_id = $faction_id;
            $this->rankmodel->create($rank);
            
            $this->session->set_flashdata('notice', 'Rank created.');
            redirect('faction/view_ranks/'.$faction->faction_id, 'refresh');
        }
    }
    
    /**
     * Delete a rank
     */
    function delete($rank_id=0)
    {
        $page = $this->page;
        
        $this->load->model('rankmodel');
        $rank = $this->rankmodel->get_by_id($rank_id);
        $this->rankmodel->delete($rank_id);
        
        $this->session->set_flashdata('notice', 'Rank deleted.');
        redirect('faction/view_ranks/'.$rank->faction_id, 'refresh');
    }
    
}

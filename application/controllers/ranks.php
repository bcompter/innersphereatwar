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
    
    /**
     * Modify a players rank
     */
    function modify($player_id=0, $rank_id=0)
    {
        $page = $this->page;
          
        $this->load->model('playermodel');
        $player = $this->playermodel->get_by_id($player_id);
        validate_exists($player->player_id, 'No such player.', 'home/dashboard');
        
        $this->load->model('factionmodel');
        $faction = $this->factionmodel->get_by_id($player->faction_id);
        
        $this->load->model('rankmodel');
        $ranks = $this->rankmodel->get_by_faction($faction->faction_id);
        
        if ($rank_id == 0)
        {
            // Show rank options view
            $page['player']     = $player;
            $page['faction']    = $faction;
            $page['ranks']      = $ranks;
            $page['content']    = 'rank_modify';
            $this->load->view('template', $page);   
        }
        else
        {
            // Assign rank and move along
            $p_update = new stdClass();
            $p_update->rank = $rank_id;
            $this->playermodel->update($player_id, $p_update);
            $this->session->set_flashdata('notice', 'Rank Updated.');
            redirect('player/view/'.$player_id, 'refresh');
            return;
        }
        
    }
    
}

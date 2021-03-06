<?php

class Token extends MY_Controller {
    
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
     * Update a tokens position
     */
    function update_position($token_id=0)
    {
        $page = $this->page;
        
        $this->load->model('tokenmodel');
        $token = $this->tokenmodel->get_by_id($token_id);
        $token->x = $this->input->post('x');
        $token->y = $this->input->post('y');
        $this->tokenmodel->update($token_id, $token);
    }
    
    /**
     * View a token
     */
    function view($token_id)
    {
        $page = $this->page;

        $this->load->model('tokenmodel');
        $this->load->model('formationmodel');
        $this->load->model('commandmodel');
        $this->load->model('combatunitmodel');
        $page['token'] = $this->tokenmodel->get_by_id($token_id);
        $page['formation'] = $this->formationmodel->get_by_id($page['token']->formation_id);
        $page['command'] = $this->commandmodel->get_by_id($page['formation']->command_id);
        $page['combatunits'] = $this->combatunitmodel->get_by_formation($page['formation']->formation_id);
        
        // Determine to hit values for each combat unit
        $skillTable['Green'] = 0;
        $skillTable['Regular'] = 1;
        $skillTable['Veteran'] = 2;
        $skillTable['Elite'] = 3;
        $loyaltyTable['Reliable'] = 0;
        $loyaltyTable['Fanatical'] = -1;
        $loyaltyTable['Questionable'] = +1;
        $moraleTable['Normal'] = 0;
        $moraleTable['Shaken'] = 1;
        $moraleTable['Unsteady'] = 2;
        $moraleTable['Broken'] = 3;
        foreach($page['combatunits'] as $c)
        {
            $tohit = 3;
            $tohit += $page['formation']->stance_mod;
            $tohit += $loyaltyTable[$page['command']->loyalty];
            $tohit += $moraleTable[$c->morale_state];
            if ($page['formation']->role == 'Recon')
                $tohit++;
            $tohit -= $skillTable[$page['command']->experience];
            if (!$page['command']->supply)
                $tohit += 3;
            $c->tohit = $tohit;
        }
        
        // Determine if this token may be viewed
        $faction_id = $page['command']->faction_id;
        $game_id = $page['command']->game_id;
        $this->load->model('playermodel');
        $player = $this->playermodel->get_by_user_game($page['user']->id, $game_id);
        if (isset($player->faction_id) && $faction_id != $player->faction_id)
        {
            $page['content'] = 'token_view_radar';
        }
        else
        {
            $page['content'] = 'token_view_detail';
        }
        if ($page['token']->detected)
        {
            $page['content'] = 'token_view_detail';
        }
        
        
        $this->load->view('templatexml', $page);
    }
    
    /**
     * Set the detection state of this token
     */
    function set_detected($token_id=0, $is_detected=0)
    {
        $page = $this->page;
        
        $this->load->model('tokenmodel');
        $token = $this->tokenmodel->get_by_id($token_id);
        $token->detected = $is_detected;
        $this->tokenmodel->update($token_id, $token);
        $this->view($token_id);
    }
    
    /**
     * Set the move state of this token
     */
    function set_moved($token_id=0, $has_moved=0)
    {
        $page = $this->page;
        
        $this->load->model('tokenmodel');
        $token = $this->tokenmodel->get_by_id($token_id);
        $token->moved = $has_moved;
        $this->tokenmodel->update($token_id, $token);
        $this->view($token_id);
    }
    
    /**
     * Set the move state of this token
     */
    function switch_role($token_id=0)
    {
        $page = $this->page;
        
        $this->load->model('tokenmodel');
        $this->load->model('formationmodel');
        $token = $this->tokenmodel->get_by_id($token_id);
        $formation = $this->formationmodel->get_by_id($token->formation_id);
        if ($formation->role == 'Combat')
        {
            $formation->role = 'Recon';
        }
        else
        {
            $formation->role = 'Combat';
        }
        $this->formationmodel->update($token->formation_id, $formation);
        $this->view($token_id);
    }
    
    /**
     * Set the tactics state of this token
     */
    function switch_tactics($token_id=0)
    {
        $page = $this->page;
        
        $this->load->model('tokenmodel');
        $this->load->model('formationmodel');
        $token = $this->tokenmodel->get_by_id($token_id);
        $formation = $this->formationmodel->get_by_id($token->formation_id);
        
        if ($formation->stance == 'Standard')
        {
            $formation->stance = 'Offensive';
        }
        else if ($formation->stance == 'Offensive')
        {
            $formation->stance = 'Defensive';
        }
        else
        {
            $formation->stance = 'Standard';
            $formation->stance_mod = 0;
        }

        $this->formationmodel->update($token->formation_id, $formation);
        $this->view($token_id);
    }
    
    /**
     * Set the tactics state of this token
     */
    function set_tactics_mod($token_id=0, $mod=0)
    {
        $page = $this->page;
        
        $this->load->model('tokenmodel');
        $this->load->model('formationmodel');
        $token = $this->tokenmodel->get_by_id($token_id);
        $formation = $this->formationmodel->get_by_id($token->formation_id);
        $formation->stance_mod = $mod;
        $this->formationmodel->update($token->formation_id, $formation);
        $this->view($token_id);
    }
    
    /**
     * Damage this formation
     * Damage is applied randomly among available combat units
     */
    function damage($token_id=0)
    {
        $page = $this->page;
        
        $damage = $this->input->post('damage');
        
        $this->load->model('tokenmodel');
        $this->load->model('formationmodel');
        $this->load->model('combatunitmodel');
        $token = $this->tokenmodel->get_by_id($token_id);
        $formation = $this->formationmodel->get_by_id($token->formation_id);
        $combatunits = $this->combatunitmodel->get_by_formation($formation->formation_id);
        $numUnits = count($combatunits);
        $roll = roll_dice(1, $numUnits);
        $combatunits[$roll]->damage += $damage;
        $this->combatunitmodel->update($combatunits[$roll]->combatunit_id, $combatunits[$roll]);
        $this->view($token_id);
    }
}

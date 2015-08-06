<?php

class Combatteam extends MY_Controller {
    
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
     * Create a new combat team from given data
     */
    function create($combatunit_id=0)
    {
        $page = $this->page;
    }
    
    /**
     * Randomly generate a combat team from a RAT table
     * The RAT table is inherited from the parent formation
     */
    function generate($combatteam_id=0)
    {
        $page = $this->page;
        
        $this->load->model('formationmodel');
        $this->load->model('combatunitmodel');
        $this->load->model('combatteammodel');
        $this->load->model('lancemodel');
        $this->load->model('unitmodel');
        $this->load->model('ratmodel');
        $this->load->model('ratdatamodel');
        $this->load->model('commandmodel');
        $this->load->model('elementmodel');
        $this->load->model('unitmodel');
        
        // Gather up basic data from the command heirarchy
        $combatteam = $this->combatteammodel->get_by_id($combatteam_id);
        $combatunit = $this->combatunitmodel->get_by_id($combatteam->combatunit_id);
        $formation = $this->formationmodel->get_by_id($combatunit->formation_id);
        $command = $this->commandmodel->get_by_id($formation->command_id);
        
        $skillTable['Green'] = 5;
        $skillTable['Regular'] = 4;
        $skillTable['Veteran'] = 3;
        $skillTable['Elite'] = 2;
        $skill = $skillTable[$command->experience];
        
        // Determine Company composition
        $roll = roll_dice(1, 6);
        $lanceWeights = array(
            array('Light', 'Medium', 'Medium'),
            array('Light', 'Medium', 'Heavy'),
            array('Medium', 'Medium', 'Heavy'),
            array('Light', 'Heavy', 'Heavy'),
            array('Heavy', 'Heavy', 'Heavy'),
            array('Heavy', 'Heavy', 'Assault'),
        );
        $lanceWeights = $lanceWeights[$roll];
        
        // Generate lances
        for ($l = 0; $l < 3; $l++)
        {
            $lance = new stdClass();
            $lance->combatteam_id = $combatteam_id;
            $lance->type = $formation->type;
            $lance->weight = $lanceWeights[$l];
            $this->lancemodel->create($lance);
        }
        $lances = $this->lancemodel->get_by_combatteam($combatteam_id);
        
        // Determine Lance composition
        $elementWeights['Light'] = array(
            array('Light', 'Light', 'Light', 'Light'),
            array('Light', 'Light', 'Light', 'Medium'),
            array('Light', 'Light', 'Light', 'Medium'),
            array('Light', 'Light', 'Medium', 'Medium'),
            array('Light', 'Light', 'Medium', 'Medium'),
            array('Light', 'Light', 'Medium', 'Heavy'),
        );
        $elementWeights['Medium'] = array(
            array('Light', 'Medium', 'Medium', 'Heavy'),
            array('Medium', 'Medium', 'Medium', 'Medium'),
            array('Medium', 'Medium', 'Medium', 'Medium'),
            array('Medium', 'Medium', 'Medium', 'Heavy'),
            array('Medium', 'Medium', 'Medium', 'Heavy'),
            array('Medium', 'Medium', 'Heavy', 'Heavy'),
        );
        $elementWeights['Heavy'] = array(
            array('Medium', 'Heavy', 'Heavy', 'Heavy'),
            array('Heavy', 'Heavy', 'Heavy', 'Heavy'),
            array('Heavy', 'Heavy', 'Heavy', 'Heavy'),
            array('Medium', 'Heavy', 'Heavy', 'Assault'),
            array('Medium', 'Heavy', 'Heavy', 'Assault'),
            array('Heavy', 'Heavy', 'Heavy', 'Assault'),
        );
        $elementWeights['Assault'] = array(
            array('Medium', 'Heavy', 'Assault', 'Assault'),
            array('Heavy', 'Heavy', 'Assault', 'Assault'),
            array('Heavy', 'Heavy', 'Assault', 'Assault'),
            array('Heavy', 'Assault', 'Assault', 'Assault'),
            array('Heavy', 'Assault', 'Assault', 'Assault'),
            array('Assault', 'Assault', 'Assault', 'Assault'),
        );
        
        // Target movement modifier lookup table
        $tmm = array(-4,0,0,1,1,2,2,2,3,3,4,4,4,4,4,4,4,4,5);
        
        // Generate four elements per lance
        foreach ($lances as $l)
        {
            $lanceweight = 0;
            $roll = roll_dice(1, 6);
            $weightTable = $elementWeights[$l->weight][$roll];
            for ($e = 0; $e < 4; $e++)
            {
                $unit = new stdClass();
                $unit->lance_id = $l->lance_id;
                $unit->type = $l->type;
                $unit->weight = $weightTable[$e];
                $this->elementmodel->create($unit);
            }
            
            // Roll against the RAT table to populate each element
            $elements = $this->elementmodel->get_by_lance($l->lance_id);
            foreach($elements as $e)
            {
                $roll = roll_dice(2, 6);
                $ratresult = $this->ratmodel->get_by_roll($command->faction, $command->tech, $e->type, $e->weight, $roll);
                $e->name = $ratresult->name;
                $e->move = $ratresult->move;            $l->move += $e->move;
                $e->jump = $ratresult->jump;            $l->jump += $e->jump;
                $e->overheat = $ratresult->overheat;
                $e->short_dmg = $ratresult->short_dmg;  $l->short_dmg += $e->short_dmg + ($e->overheat/2);
                $e->med_dmg = $ratresult->med_dmg;      $l->med_dmg += $e->med_dmg + ($e->overheat/2);
                $e->long_dmg = $ratresult->long_dmg;    $l->long_dmg += $e->long_dmg + ($e->overheat/2);
                $e->armor = $ratresult->armor;          $l->armor += $e->armor;
                $e->structure = $ratresult->structure;  $l->armor += $e->structure;
                $e->special = $ratresult->special;
                $this->elementmodel->update($e->element_id, $e);
                
                // Special cases
                if($e->structure > 3)
                    $l->armor += 0.5;
                if (strpos($e->special, 'ENE') !== FALSE)
                    $l->armor += 1;
            }
            
            // Aggregate lance data
            $l->move = round($l->move / count($l));
            $l->tmm = $tmm[$l->move];
            $l->jump = round(($l->jump / count($l)) / 2);
            $l->armor = round($l->armor / 3);
            $l->short_dmg = round($l->short_dmg / 3);
            $l->med_dmg = round($l->med_dmg / 3);
            $l->long_dmg = round($l->long_dmg / 3);
            $this->lancemodel->update($l->lance_id, $l);
            
        }  // end foreach lance

        // Refetch modified lance data
        $lances = $this->lancemodel->get_by_combatteam($combatteam_id);
        $jump = 0;
        foreach($lances as $l)
        {
            $combatteam->move += $l->move;
            $jump += $l->jump;
            $combatteam->tmm += $l->tmm;
            $combatteam->armor += $l->armor;
        }
        $combatteam->move = round($combatteam->move / count($lances));
        $jump = round($jump / 3);
        $combatteam->tmm = round($combatteam->tmm / count($lances)) + $jump;
        $combatteam->armor = round($combatteam->armor / 3);
        $combatteam->short_dmg = round($combatteam->short_dmg / 3);
        $combatteam->med_dmg = round($combatteam->med_dmg / 3);
        $combatteam->long_dmg = round($combatteam->long_dmg / 3);
        $combatteam->tactics = 10 - $combatteam->move + (skill - 4);
        $combatteam->morale = $skill + 3;
        $this->combatteammodel->update($combatteam_id, $combatteam);
        
        $this->session->set_flashdata('notice', 'Combat team generated.');
        redirect('combatunit/view/'.$combatunit_id, 'refresh');
    }
    
    /**
     * Delete a combat team
     */
    function delete($combatteam_id=0)
    {
        $page = $this->page;
        
        $this->load->model('combatteammodel');
        $this->load->model('combatunitmodel');
        $combatteam = $this->combatteammodel->get_by_id($combatteam_id);
        $combatunit = $this->combatunitmodel->get_by_id($combatteam->combatunit_id);
        
        $this->combatteammodel->delete($combatteam_id);
        
        $this->session->set_flashdata('notice', 'Combat team deleted.');
        redirect('combatunit/view/'.$combatunit->combatunit_id, 'refresh');
    }
    
    /**
     * View this combatteam
     */
    function view($combatteam_id=0)
    {
        $page = $this->page;
        
        $this->load->model('combatteammodel');
        $this->load->model('combatunitmodel');
        $this->load->model('lancemodel');
        $this->load->model('elementmodel');
        $page['combatteam'] = $this->combatteammodel->get_by_id($combatteam_id);
        $page['combatunit'] = $this->combatunitmodel->get_by_id($page['combatteam']->combatunit_id);
        $page['lances'] = $this->lancemodel->get_by_combatteam($combatteam_id);
        foreach($page['lances'] as $l)
        {
            $page['elements'][] = $this->elementmodel->get_by_lance($l->lance_id);
        }
        $page['content'] = 'combatteam_view';
        
        $this->load->view('template', $page);
    }
}

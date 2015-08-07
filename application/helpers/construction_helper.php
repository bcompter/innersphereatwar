<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generate_formation'))
{
    function generate_formation($formation_id=0)
    {
        $CI =& get_instance();
        
        $CI->load->model('formationmodel');
        $CI->load->model('combatunitmodel');
        
        // Add three combat units to this formation
        $formation = $CI->formationmodel->get_by_id($formation_id);
        for ($i = 0; $i < 3; $i++)
        {
            $combatunit = new stdClass();
            $combatunit->name = 'Battalion '.($i+1);
            $combatunit->formation_id = $formation_id;
            $CI->combatunitmodel->create($combatunit);
        }
        
        // Generate each combat unit
        $combatunits = $CI->combatunitmodel->get_by_formation($formation_id);
        foreach ($combatunits as $c)
        {
            generate_combatunit($c->combatunit_id);
        }
        
        // Calculate this formation
        calculate_formation($formation_id);
    }
}

if ( ! function_exists('generate_combatunit'))
{
    function generate_combatunit($combatunit_id=0)
    {
        $CI =& get_instance();
        
        $CI->load->model('commandmodel');
        $CI->load->model('formationmodel');
        $CI->load->model('combatunitmodel');
        $CI->load->model('combatteammodel');
        
        // Add three combat teams to this combat unit
        $combatunit = $CI->combatunitmodel->get_by_id($combatunit_id);
        for ($i = 0; $i < 3; $i++)
        {
            $combatteam = new stdClass();
            $combatteam->name = 'Company '.($i+1);
            $combatteam->combatunit_id = $combatunit_id;
            $CI->combatteammodel->create($combatteam);
        }
        
        // Generate each combat team
        $combatteams = $CI->combatteammodel->get_by_combatunit($combatunit_id);
        foreach ($combatunits as $c)
        {
            generate_combatunit($c->combatunit_id);
        }
        
        // Calculate this combatunit
        calculate_combatunit($combatunit_id);
    }
}

if ( ! function_exists('calculate_combatunit'))
{
    function calculate_combatunit($combatunit_id=0)
    {
        $CI =& get_instance();
        $CI->load->model('combatteammodel');
        $CI->load->model('combatunitmodel');

        // Calculate combat unit stats from the aggregate combat teams
        $combatunit = $CI->combatunitmodel->get_by_id($combatunit_id);
        $combatteams = $CI->combatteammodel->get_by_combatunit($combatunit_id);
        foreach($combatteams as $c)
        {
            $combatunit->move += $c->move;
            $combatunit->tmm += $c->tmm;
            $combatunit->armor += $c->armor;
            $combatunit->short_dmg += $c->short_dmg;
            $combatunit->med_dmg += $c->med_dmg;
            $combatunit->long_dmg += $c->long_dmg;
        }
        $combatunit->move = round($combatunit->move / count($combatteams));
        $combatunit->tmm = round($combatunit->tmm / count($combatteams));
        $combatunit->tactics = 10 - $combatteam->move + ($skill - 4);
        $CI->combatunitmodel->update($combatunit_id, $combatunit);
    }
}

if ( ! function_exists('calculate_formation'))
{
    function calculate_formation($formation_id=0)
    {
        $CI =& get_instance();
        
        $CI->load->model('formationmodel');
        $CI->load->model('combatunitmodel');
        $CI->load->model('commandmodel');
        
        // Calculate formation stats from the aggregate combat units
        $formation = $CI->formationmodel->get_by_id($formation_id);
        $combatunits = $CI->combatunitmodel->get_by_formation($formation_id);
        $command = $CI->commandmodel->get_by_formation($formation_id);

        // Skill lookup table
        $skillTable['Green'] = 5;
        $skillTable['Regular'] = 4;
        $skillTable['Veteran'] = 3;
        $skillTable['Elite'] = 2;
        $skill = $skillTable[$command->experience];
        
        $formation->move = 99;
        $formation->morale = 99;
        foreach ($combatunits as $c)
        {
            if ($c->move < $formation->move)
            {
                $formation->move = $c->move;
            }
            if ($c->morale < $formation->morale)
            {
                $formation->morale = $c->morale;
            }
        }
        $formation->tactics = 10 - $formation->move + ($skill - 4);
        $CI->formationmodel->update($formation_id, $formation);
    }
}

if ( ! function_exists('generate_combatteam'))
{
    function generate_combatteam($combatteam_id=0)
    {
        $CI =& get_instance();
        
        $CI->load->model('formationmodel');
        $CI->load->model('combatunitmodel');
        $CI->load->model('combatteammodel');
        $CI->load->model('lancemodel');
        $CI->load->model('unitmodel');
        $CI->load->model('ratmodel');
        $CI->load->model('ratdatamodel');
        $CI->load->model('commandmodel');
        $CI->load->model('elementmodel');
        $CI->load->model('unitmodel');
        $CI->load->model('factionmodel');
        
        // Gather up basic data from the command heirarchy
        $combatteam = $CI->combatteammodel->get_by_id($combatteam_id);
        $combatunit = $CI->combatunitmodel->get_by_id($combatteam->combatunit_id);
        $formation = $CI->formationmodel->get_by_id($combatunit->formation_id);
        $command = $CI->commandmodel->get_by_id($formation->command_id);
        $faction = $CI->factionmodel->get_by_id($command->faction_id);
        
        // Skill lookup table
        $skillTable['Green'] = 5;
        $skillTable['Regular'] = 4;
        $skillTable['Veteran'] = 3;
        $skillTable['Elite'] = 2;
        $skill = $skillTable[$command->experience];
        
        // Size lookup table
        $sizeTable['Light'] = 1;
        $sizeTable['Medium'] = 2;
        $sizeTable['Heavy'] = 3;
        $sizeTable['Assault'] = 4;
        $altSizeTable[1] = 'Light';
        $altSizeTable[2] = 'Medium';
        $altSizeTable[3] = 'Heavy';
        $altSizeTable[4] = 'Assault';
        
        // Determine Company composition
        $roll = roll_dice(1, 6) - 1;
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
            $CI->lancemodel->create($lance);
        }
        $lances = $CI->lancemodel->get_by_combatteam($combatteam_id);
        
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
            $roll = roll_dice(1, 6) - 1;
            $weightTable = $elementWeights[$l->weight][$roll];
            $numElements = 4;
            if ($l->type == 'Aero')
            {
                $numElements = 2;
            }
            for ($e = 0; $e < $numElements; $e++)
            {
                $unit = new stdClass();
                $unit->lance_id = $l->lance_id;
                $unit->type = $l->type;
                $unit->weight = $weightTable[$e];
                $CI->elementmodel->create($unit);
            }
            
            // Roll against the RAT table to populate each element
            $elements = $CI->elementmodel->get_by_lance($l->lance_id);
            foreach($elements as $e)
            {
                $roll = roll_dice(2, 6);
                $ratresult = $CI->ratmodel->get_by_roll($faction->name, $command->tech, $e->type, $e->weight, $roll);
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
                $CI->elementmodel->update($e->element_id, $e);
                
                // Special cases
                if($e->structure > 3 || strpos($e->special, 'CASE') !== FALSE || strpos($e->special, 'AMS') !== FALSE)
                {
                    $l->armor += 0.5;
                }
                
                if (strpos($e->special, 'ENE') !== FALSE)
                {
                    $l->armor += 1;
                }
            }
            
            // Aggregate lance data
            $l->move        = round($l->move / count($elements));
            $l->tmm         = $tmm[$l->move];
            $l->jump        = round(($l->jump / count($elements)) / 2);
            $l->armor       = round($l->armor / 3);
            $l->short_dmg   = round($l->short_dmg / 3);
            $l->med_dmg     = round($l->med_dmg / 3);
            $l->long_dmg    = round($l->long_dmg / 3);
            $CI->lancemodel->update($l->lance_id, $l);
            
        }  // end foreach lance

        // Refetch modified lance data
        $lances = $CI->lancemodel->get_by_combatteam($combatteam_id);
        $jump = 0;
        $size = 0;
        foreach($lances as $l)
        {
            $combatteam->move       += $l->move;
            $jump                   += $l->jump;
            $combatteam->tmm        += $l->tmm;
            $combatteam->armor      += $l->armor;
            $combatteam->short_dmg  += $l->short_dmg;
            $combatteam->med_dmg    += $l->med_dmg;
            $combatteam->long_dmg   += $l->long_dmg;
            $size += $sizeTable[$l->weight];
        }
        $size                   = round($size / count($lances));
        $combatteam->size       = $altSizeTable[$size];
        $combatteam->move       = round($combatteam->move / count($lances));
        $jump                   = round($jump / 3);
        $combatteam->tmm        = round($combatteam->tmm / count($lances)) + $jump;
        $combatteam->armor      = round($combatteam->armor / 3);
        $combatteam->short_dmg  = round($combatteam->short_dmg / 3);
        $combatteam->med_dmg    = round($combatteam->med_dmg / 3);
        $combatteam->long_dmg   = round($combatteam->long_dmg / 3);
        $CI->combatteammodel->update($combatteam_id, $combatteam);
    }
}
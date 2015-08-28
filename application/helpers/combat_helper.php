<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('fast_resolve'))
{
    function fast_resolve($planet_id)
    {
        $CI =& get_instance();
        
        // Load resources and fetch data
        $CI->load->model('planetmodel');
        $CI->load->model('factionmodel');
        $CI->load->model('commandmodel');
        $CI->load->model('formationmodel');
        $CI->load->model('combatunitmodel');
        
        $planet = $CI->planetmodel->get_by_id($planet_id);
        $factions = $CI->factionmodel->get_by_game($planet->game_id);
        if (count($factions) != 2)
        {
            log_message('error', 'fast_resolve failed due to invalid numebr of factions on '.$planet->name);
            return;
        }
        $commands = $CI->commandmodel->get_by_planet_for_combat($planet_id);
        $formations = $CI->formationmodel->get_by_planet_for_combat($planet_id);
        $combatunits = $CI->combatunitmodel->get_by_planet_for_combat($planet_id);
        
        // Determine LR rating of each faction
        $lrTable['Green'] = 1;
        $lrTable['Regular'] = 2;
        $lrTable['Veteran'] = 4;
        $lrTable['Elite'] = 6;
        $factionArray;
        foreach($factions as $f)
        {
            $factionArray[$f->faction_id] = $f;
            $factionArray[$f->faction_id]->lr = 0;
            $factionArray[$f->faction_id]->num_recon = 0;
            $factionArray[$f->faction_id]->initBonus = 0;
            $factionArray[$f->faction_id]->damageBonus = 0;
        }
        foreach($commands as $c)
        {
            $f_id = $c->f_id;
            if ($factionArray[$f_id]->lr < $lrTable[$c->faction_id])
            {
                $factionArray[$f_id]->lr = $lrTable[$c->faction_id];
            }
        }
        
        // Initiative
        $fs = (array)$factions;
        $rollA = roll_dice(2, 6) + $factionArray[$fs[0]->faction_id]->lr;
        $rollB = roll_dice(2, 6) + $factionArray[$fs[1]->faction_id]->lr;
        if ($rollA > $rollB)
        {
            $factionArray[$fs[0]->faction_id]->initBonus = 1;
        }
        else
        {
            $factionArray[$fs[1]->faction_id]->initBonus = 1;
        }
        
        // Recon
        foreach($formations as $f)
        {
            if ($f->role == 'Recon')
            {
                $factionArray[$f->faction_id]->num_recon++;
            }
        }
        $rollA = roll_dice(2, 6) + $factionArray[$fs[0]->faction_id]->num_recon*2;
        $rollB = roll_dice(2, 6) + $factionArray[$fs[1]->faction_id]->num_recon*2;
        if ($rollA > $rollB)
        {
            $factionArray[$fs[0]->faction_id]->damageBonus = 0.1;
        }
        else
        {
            $factionArray[$fs[1]->faction_id]->damageBonus = 0.1;
        }
        
        // Engagement
        foreach($formation as $f)
        {
            
        }
        
        // Combat
        foreach($combatunits as $c)
        {
            
        }
        
        // Damage resolution
        
    }
}
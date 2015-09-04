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
        $rollA = roll_dice(2, 6) + $factionArray[$fs[0]->faction_id]->num_recon*2 + $factionArray[$fs[0]->faction_id]->initBonus;
        $rollB = roll_dice(2, 6) + $factionArray[$fs[1]->faction_id]->num_recon*2 + $factionArray[$fs[1]->faction_id]->initBonus;
        if ($rollA > $rollB)
        {
            $factionArray[$fs[0]->faction_id]->damageBonus = 0.1;
        }
        else
        {
            $factionArray[$fs[1]->faction_id]->damageBonus = 0.1;
        }
        
        // Engagement, roll and store engagement roll
        // Affected by LR, Loyalty, recon, skill, morale, fatigue, supply
        $engageExp['Green'] = 1;
        $engageExp['Regular'] = 0;
        $engageExp['Veteran'] = -1;
        $engageExp['Elite'] = -2;
        $engageLoyalty['Questionable'] = 1;
        $engageLoyalty['Reliable'] = 0;
        $engageLoyalty['Fanatical'] = -1;
        $engageMorale['Normal'] = 0;
        $engageMorale['Shaken'] = 1;
        $engageMorale['Unsteady'] = 2;
        $engageMorale['Broken'] = 3;
        foreach($formations as $f)
        {
            $target = $f->tactics;
            $target += $engageExp[$f->experience];
            if ($f->role == 'Recon')
            {
                $target += 2;
            }
            $target -= $factionArray[$f->faction_id]->lr;
            $target += $engageLoyalty[$f->loyalty];
            $target += (!$f->supply) * 3;
            $target += $engageMorale[$f->morale];
        }
        
        // Combat
        foreach($combatunits as $c)
        {
            
        }
        
        // Damage resolution
        $combatunitarray = (array)$combatunits;
        foreach($combatunits as $c)
        {
            
        }
    }  // end fast_resolve
}
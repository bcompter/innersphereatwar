<?php

Class Tokenmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'token_id';
        $this->table = 'tokens';
    }
    
    /**
     * Get all tokens located on a planet
     * on either the ground or aero maps
     */
    function get_by_planet($planet_id=0, $location=0)
    {
        return $this->db->query('SELECT tokens.*, factions.color, formations.type, formations.name AS formation_name'
                . ' FROM tokens '
                . 'JOIN planets ON planets.planet_id=tokens.planet_id '
                . 'JOIN formations ON formations.formation_id=tokens.formation_id '
                . 'JOIN combat_commands ON combat_commands.command_id=formations.command_id '
                . 'JOIN factions ON factions.faction_id=combat_commands.faction_id '
                . 'WHERE tokens.planet_id='.$planet_id.' '
                . 'AND tokens.location="'.$location.'"')->result();
    }
    
}
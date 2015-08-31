<?php

Class Commandmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'command_id';
        $this->table = 'combat_commands';
    }
    
    /**
     * Get all combat commands in a faction
     */
    function get_by_faction($faction_id)
    {
        return $this->db->query('SELECT combat_commands.*, planets.name AS planet_name, orders.order_id '
                . 'FROM combat_commands '
                . 'LEFT JOIN planets on planets.planet_id=combat_commands.planet_id '
                . 'LEFT JOIN orders on orders.command_id=combat_commands.command_id '
                . 'WHERE combat_commands.faction_id='.$faction_id.' '
                . 'GROUP BY combat_commands.command_id')->result();        
    }
    
    /**
     * Get all commands on a planet
     */
    function get_by_planet($planet_id)
    {
        return $this->db->query('SELECT combat_commands.*, factions.name AS faction_name, factions.faction_id FROM combat_commands '
                . 'JOIN factions on factions.faction_id=combat_commands.faction_id '
                . 'WHERE planet_id='.$planet_id)->result(); 
    }
    
}
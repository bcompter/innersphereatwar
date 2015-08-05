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
        return $this->db->query('SELECT * FROM combat_commands WHERE faction_id='.$faction_id)->result();        
    }
    
    /**
     * Get all formations on a planet
     */
    function get_by_planet($planet_id)
    {
        return $this->db->query('SELECT * FROM combat_commands WHERE planet_id='.$planet_id)->result(); 
    }
    
}
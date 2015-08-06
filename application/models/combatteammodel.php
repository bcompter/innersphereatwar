<?php

Class Combatteammodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'combatteam_id';
        $this->table = 'combatteams';
    }

    /**
     * Get all combat teams attached to a combat unit
     */
    function get_by_combatunit($combatunit_id)
    {
        return $this->db->query('SELECT * FROM combatteams WHERE combatunit_id='.$combatunit_id)->result();
    }
    
}
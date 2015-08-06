<?php

Class Lancemodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'lance_id';
        $this->table = 'lances';
    }
    
    /**
     * Get all lances attatched to a combat team
     */
    function get_by_combatteam($combatteam_id)
    {
        return $this->db->query('SELECT * FROM lances WHERE combatteam_id='.$combatteam_id)->result();
    }
    
}
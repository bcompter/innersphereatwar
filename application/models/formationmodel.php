<?php

Class Formationmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'formation_id';
        $this->table = 'formations';
    }
    
    /**
     * Get all formations attached to a command
     */
    function get_by_command($command_id)
    {
        return $this->db->query('SELECT * FROM formations WHERE command_id='.$command_id)->result();
    }
    
    /**
     * Get all formations in a hex
     * Todo... Finish up
     */
    function get_by_planet_hex($planet_id, $row, $col)
    {
        return $this->db->query('SELECT * FROM formations WHERE location_id='.$planet_id)->result();
    }
}
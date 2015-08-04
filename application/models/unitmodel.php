<?php

Class Unitmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'unit_id';
        $this->table = 'units';
    }
    
    /**
     * Get all units on the server
     */
    function get_all()
    {
        return $this->db->query('SELECT * FROM units')->result();
    }
    
}
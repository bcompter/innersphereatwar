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
    
    /**
     * Get all units of a particular size
     */
    function get_by_size_type($size, $type)
    {
        return $this->db->query('SELECT * FROM units WHERE size="'.$size.'" AND type="'.$type.'" ORDER BY name ASC')->result();
    }
    
}
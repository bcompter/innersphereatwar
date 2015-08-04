<?php

Class Ratmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'rat_id';
        $this->table = 'rat';
    }
    
    /**
     * Get all RATs on the server
     */
    function get_all()
    {
        return $this->db->query('SELECT * FROM rat')->result();
    }
    
}
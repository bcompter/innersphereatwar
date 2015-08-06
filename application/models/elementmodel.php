<?php

Class Elementmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'element_id';
        $this->table = 'elements';
    }
    
    /**
     * Get all elements attached to a given lance
     */
    function get_by_lance($lance_id)
    {
        return $this->db->query('SELECT * FROM elements WHERE lance_id='.$lance_id)->result();
    }
}
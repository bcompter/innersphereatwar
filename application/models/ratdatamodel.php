<?php

Class Ratdatamodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'data_id';
        $this->table = 'rat_data';
    }
    
    /**
     * Get all data for a given RAT table
     */
    function get_by_rat($rat_id)
    {
        return $this->db->query('SELECT * FROM rat_data WHERE rat_id='.$rat_id)->result();
    }
    
}
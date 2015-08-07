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
        return $this->db->query('SELECT rat_data.* FROM rat_data WHERE rat_id='.$rat_id)->result();
    }
    
    /**
     * Get all data for a given RAT table
     */
    function get_by_rat_size($rat_id, $size)
    {
        return $this->db->query('SELECT rat_data.* FROM rat_data '
                . 'JOIN units ON units.unit_id=rat_data.unit_id '
                . ' WHERE rat_id='.$rat_id.' '
                . 'AND size="'.$size.'"')->result();
    }
    
}
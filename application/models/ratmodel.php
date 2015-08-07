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
    
    /**
     * Get a unit from a rat table
     */
    function get_by_roll($faction, $tech, $type, $weight, $roll)
    {
        // First find the correct RAT table
        $rat = $this->ratmodel->get_by_data($faction, $tech, $type, $weight);
        
        // Next return the correct unit
        $this->load->model('ratdatamodel');
        $data = $this->ratdatamodel->get_by_rat($rat->rat_id);
        foreach($data as $d)
        {
            if ($d->roll == $roll)
            {
                $this->load->model('unitmodel');
                return $this->unitmodel->get_by_id($d->unit_id);
            }
        }
    }
    
    /**
     * Find a RAT table given specific data
     */
    function get_by_data($faction, $tech, $type, $weight)
    {
        return $this->db->query('SELECT * FROM rat WHERE faction="'.$faction.'" '
                . 'AND tech="'.$tech.'" '
                . 'AND type="'.$type.'" '
                . 'AND size="'.$weight.'" LIMIT 1')->row();
    }
    
}
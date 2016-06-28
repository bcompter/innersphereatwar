<?php

Class Rankmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'rank_id';
        $this->table = 'ranks';
    }
    
    /**
     * Get all ranks by faction
     */
    function get_by_faction($faction_id)
    {
        return $this->db->query('SELECT * FROM ranks WHERE faction_id='.$faction_id.' ORDER BY order_num asc')->result();
    }
    
}
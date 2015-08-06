<?php

Class Combatunitmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'combatunit_id';
        $this->table = 'combatunits';
    }
    
    /**
     * Get all combat units attached to this formation
     */
    function get_by_formation($formation_id)
    {
        return $this->db->query('SELECT * FROM combatunits WHERE formation_id='.$formation_id)->result();
    }
    
}
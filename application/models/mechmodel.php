<?php

Class Mechmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'mech_id';
        $this->table = 'mechs';
    }
    
}
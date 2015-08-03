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
    
}
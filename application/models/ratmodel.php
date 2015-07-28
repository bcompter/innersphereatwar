<?php

Class Ratmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'rat_id';
        $this->table = 'rats';
    }
    
}
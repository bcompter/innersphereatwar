<?php

Class Amodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'table_id';
        $this->table = 'table';
    }
    
}
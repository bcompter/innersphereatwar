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
    
}
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
    
}
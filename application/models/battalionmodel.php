<?php

Class Battalionmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'battalion_id';
        $this->table = 'battalions';
    }
    
}
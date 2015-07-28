<?php

Class Planetmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'planet_id';
        $this->table = 'planets';
    }
    
}
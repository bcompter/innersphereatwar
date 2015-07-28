<?php

Class Lancemodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'lance_id';
        $this->table = 'lances';
    }
    
}
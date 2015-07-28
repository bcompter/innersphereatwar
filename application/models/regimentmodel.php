<?php

Class Regimentmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'regiment_id';
        $this->table = 'regiments';
    }
    
}
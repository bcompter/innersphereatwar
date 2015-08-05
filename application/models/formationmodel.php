<?php

Class Formationmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'formation_id';
        $this->table = 'formations';
    }
    
}
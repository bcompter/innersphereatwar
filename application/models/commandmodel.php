<?php

Class Commandmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'combatcommand_id';
        $this->table = 'combatcommands';
    }
    
}
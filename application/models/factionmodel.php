<?php

Class Factionmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'faction_id';
        $this->table = 'factions';
    }
    
}
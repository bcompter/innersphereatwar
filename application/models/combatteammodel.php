<?php

Class Combatteammodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'team_id';
        $this->table = 'combatteams';
    }
    
}
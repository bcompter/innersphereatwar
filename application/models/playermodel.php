<?php

Class Playermodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'player_id';
        $this->table = 'players';
    }
    
}
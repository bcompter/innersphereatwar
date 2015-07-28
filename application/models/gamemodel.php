<?php

Class Gamemodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'game_id';
        $this->table = 'games';
    }
    
}
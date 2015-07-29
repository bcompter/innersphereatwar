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
    
    /**
     * Get a list of all games on the server
     */
    function get_all()
    {
        return $this->db->query('SELECT * FROM games')->result();
    }
    
}
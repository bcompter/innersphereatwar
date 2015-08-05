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
    
    /**
     * Get all planets in a game
     */
    function get_by_game($game_id)
    {
        return $this->db->query('SELECT * FROM planets WHERE game_id='.$game_id)->result();
    }
    
}
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
    
    /**
     * Get all players associated with a faction
     */
    function get_by_faction($faction_id)
    {
        return $this->db->query('SELECT players.*, users.username AS username FROM players '
                . 'JOIN users ON users.id=players.user_id '
                . 'WHERE faction_id='.$faction_id)->result();
    }
    
}
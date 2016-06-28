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
    
    /**
     * Get all players associated with a faction
     */
    function get_by_game($game_id)
    {
        return $this->db->query('SELECT players.*, users.username AS username FROM players '
                . 'JOIN users ON users.id=players.user_id '
                . 'WHERE game_id='.$game_id)->result();
    }
    
    /**
     * Get a player belonging to a particular user in a game
     */
    function get_by_user_game($user_id, $game_id)
    {
        return $this->db->query('SELECT * FROM players WHERE user_id='.$user_id.' AND game_id='.$game_id.' limit 1')->row();
    }
    
}
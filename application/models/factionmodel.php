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
    
    /**
     * Get all factions in a game
     */
    function get_by_game($game_id)
    {
        return $this->db->query('SELECT factions.* FROM factions WHERE game_id='.$game_id)->result();
    }
    
    /**
     * Get a faction based on the game and the logged in user
     */
    function get_by_game_user($game_id, $user_id)
    {
        return $this->db->query('SELECT factions.*, users.username AS username FROM factions '
                . 'JOIN players ON players.faction_id=factions.faction_id '
                . 'JOIN users ON users.id=players.user_id '
                . 'WHERE factions.game_id='.$game_id.' '
                . 'AND users.id='.$user_id)->row();
    }
    
}
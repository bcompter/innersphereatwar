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
     * Get a panet by its id, including the faction name
     */
    function get_detail_by_id($id)
    {
        return $this->db->query('SELECT planets.*, factions.name AS faction_name FROM planets '
                . 'JOIN factions ON factions.faction_id=planets.faction_id '
                . 'WHERE planet_id='.$id)->row();
    }
    
    /**
     * Get all planets in a game
     */
    function get_by_game($game_id)
    {
        return $this->db->query('SELECT * FROM planets WHERE game_id='.$game_id)->result();
    }
    
}
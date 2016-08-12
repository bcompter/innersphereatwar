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
                . 'LEFT JOIN factions ON factions.faction_id=planets.faction_id '
                . 'WHERE planet_id='.$id)->row();
    }
    
    /**
     * Get all planets in a game
     */
    function get_by_game($game_id)
    {
        return $this->db->query('SELECT * FROM planets WHERE game_id='.$game_id)->result();
    }
    
    /**
     * Get all the OTHER type planets by faction
     */
    function get_by_faction_other($faction_id)
    {
        return $this->db->query('SELECT planets.*, factions.name AS faction_name FROM planets '
                . 'LEFT JOIN factions ON factions.faction_id=planets.faction_id '
                . 'WHERE type="other"')->result();
    }
    
    /**
     * Get all the MINOR type planets by faction
     */
    function get_by_faction_minor($faction_id)
    {
        return $this->db->query('SELECT planets.*, factions.name AS faction_name FROM planets '
                . 'LEFT JOIN factions ON factions.faction_id=planets.faction_id '
                . 'WHERE type="minor"')->result();
    }
    
    /**
     * Get all the MAJOR type planets by faction
     */
    function get_by_faction_major($faction_id)
    {
        return $this->db->query('SELECT planets.*, factions.name AS faction_name FROM planets '
                . 'LEFT JOIN factions ON factions.faction_id=planets.faction_id '
                . 'WHERE type="major"')->result();
    }
    
    /**
     * Get all the HYPER type planets by faction
     */
    function get_by_faction_hyper($faction_id)
    {
        return $this->db->query('SELECT planets.*, factions.name AS faction_name FROM planets '
                . 'LEFT JOIN factions ON factions.faction_id=planets.faction_id '
                . 'WHERE type="hyper"')->result();
    }
    
    /**
     * Get all the REGIONAL type planets by faction
     */
    function get_by_faction_regional($faction_id)
    {
        return $this->db->query('SELECT planets.*, factions.name AS faction_name FROM planets '
                . 'LEFT JOIN factions ON factions.faction_id=planets.faction_id '
                . 'WHERE is_regional=1')->result();
    }
    
    /**
     * Get all the NATIONAL type planets by faction
     */
    function get_by_faction_national($faction_id)
    {
        return $this->db->query('SELECT planets.*, factions.name AS faction_name FROM planets '
                . 'LEFT JOIN factions ON factions.faction_id=planets.faction_id '
                . 'WHERE is_national=1')->result();
    }
    
}
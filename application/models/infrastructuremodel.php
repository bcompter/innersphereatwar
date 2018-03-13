<?php

Class Infrastructuremodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'upgrade_id';
        $this->table = 'upgrade_orders';
    }
    
    /**
     * Get this planet's upgrade order if any exists
     */
    function get_by_planet($planet_id)
    {
        return $this->db->query('SELECT * FROM upgrade_orders WHERE planet_id='.$planet_id)->row();        
    }
    
    /**
     * Get all upgrade orders in a game
     */
    function get_by_game($game_id)
    {
        return $this->db->query('SELECT * FROM upgrade_orders'
                . ' JOIN planets ON planets.planet_id=upgrade_orders.planet_id'
                . ' JOIN games ON games.game_id=planets.game_id'
                . ' WHERE planets.game_id='.$game_id)->result();        
    }
    
}
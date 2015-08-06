<?php

Class Tokenmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'token_id';
        $this->table = 'tokens';
    }
    
    /**
     * Get all tokens located on a planet
     * on either the ground or aero maps
     */
    function get_by_planet($planet_id=0, $location=0)
    {
        return $this->db->query('SELECT tokens.* FROM tokens '
                . 'JOIN planets ON planets.planet_id=tokens.planet_id '
                . 'WHERE tokens.planet_id='.$planet_id.' '
                . 'AND tokens.location="'.$location.'"')->result();
    }
    
}
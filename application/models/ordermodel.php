<?php

Class Ordermodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'order_id';
        $this->table = 'orders';
    }
    
    /**
     * Delete all orders in a game
     */
    function clear($game_id)
    {
        $this->db->query('DELETE FROM orders WHERE game_id='.$game_id);
    }
    
    /**
     * Get all orders belonging to a command
     */
    function get_by_command($command_id)
    {
        return $this->db->query('SELECT * FROM orders WHERE command_id='.$command_id)->result();
    }    
    
}
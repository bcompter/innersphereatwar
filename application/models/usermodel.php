<?php

Class Usermodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'id';
        $this->table = 'users';
    }
    
    /**
     * Get all users in the system
     */
    function get_all()
    {
        return $this->db->query('SELECT * FROM users')->result();
    }
    
}
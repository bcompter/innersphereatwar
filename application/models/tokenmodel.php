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
    
}
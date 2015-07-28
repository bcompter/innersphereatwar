<?php

Class Elementmodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'element_id';
        $this->table = 'elements';
    }
    
}
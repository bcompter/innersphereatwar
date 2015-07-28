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
    
}
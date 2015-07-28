<?php

Class Companymodel extends MY_Model {

    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->table_id = 'company_id';
        $this->table = 'companies';
    }
    
}
<?php

class Home extends MY_Controller {
    
    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Show the landing page
     */
    function index()
    {
        $page = $this->page;
        $page['content'] = 'landing';
        $this->load->view('template', $page);
    }
    
}

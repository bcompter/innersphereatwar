<?php

class Users extends MY_Controller {
    
    /**
     * Default constructor
     */
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * View all users registered on the site
     */
    function view()
    {
        $this->load->model('usermodel');
        $page['users'] = $this->usermodel->get_all();
        
        $page['content'] = 'users_view_all';
        $this->load->view('template', $page);
    }
    
}

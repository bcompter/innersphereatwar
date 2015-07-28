<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    var $page = null;

    function __construct()
    {
        parent::__construct();

        // Get user if logged in
        if ($this->ion_auth->logged_in())
        {
            $this->page['user'] = $this->ion_auth->get_user();
        }
    }
}
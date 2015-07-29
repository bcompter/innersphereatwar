<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! class_exists('Controller'))
{
	class Controller extends CI_Controller {}
}

class Auth extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('url');
    }

    //redirect if needed, otherwise display the user list
    function index()
    {
        $page = $this->page;
        if (!$this->ion_auth->logged_in())
        {
                //redirect them to the login page
                redirect('auth/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin())
        {
                //redirect them to the home page because they must be an administrator to view this
                redirect($this->config->item('base_url'), 'refresh');
        }
        else
        {
                //set the flash data error message if there is one
                $page['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                //list the users
                $page['users'] = $this->ion_auth->get_users_array();       
                $page['content'] = 'auth/index';
                $this->load->view('template', $page);
        }
    }

    // register a new user
    function register()
    {
        // Check if registration is allowed
        $this->load->model('adminmodel');
        $admin = $this->adminmodel->get_by_id(1);
        if ( !$admin->allow_register )
        {
            $page['error'] = 'Sorry to say but user registration is currently disabled.';
            $page['content'] = 'welcome_message';
            $this->load->view('template', $page);

            return;
        }

        $this->data['title'] = "Login";

        //validate form input
        $this->form_validation->set_rules('username', 'User Name', 'required|callback__usernameavailable');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|callback__emailavailable');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == true)
        { 
            // register the user
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);
            $email = $this->input->post('email', true);
            $additionaldata = array();
            $groupname = 'members';

            $this->ion_auth->register($username, $password, $email, $additionaldata, $groupname);

            // Back to the home page
            $page['notice'] = 'Check your email for your activation code!';
            $page['content'] = 'welcome_message';
            $this->load->view('template', $page);
        }
        else
        {   
            //set the flash data error message if there is one
            $page['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            // Reset data if applicable
            $page['username'] = array('name' => 'username',
                    'id' => 'username',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('username'),
            );
            $page['email'] = array('name' => 'email',
                    'id' => 'email',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('email'),
            );
            $page['password'] = array('name' => 'password',
                    'id' => 'password',
                    'type' => 'password',
            );
            $page['confirmpassword'] = array('name' => 'confirmpassword',
                    'id' => 'confirmpassword',
                    'type' => 'password',
            );

            $page['content'] = 'auth/register';
            $this->load->view('template', $page);
        }
    }

    //log the user in
    function login()
    {
            $this->data['title'] = "Login";

            //validate form input
            $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == true)
            { //check to see if the user is logging in
                    //check for "remember me"
                    $remember = (bool) $this->input->post('remember');

                    if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
                    { //if the login is successful
                            //redirect them back to the home page
                            $this->session->set_flashdata('message', $this->ion_auth->messages());
                            redirect($this->config->item('base_url'), 'refresh');
                    }
                    else
                    { //if the login was un-successful
                            //redirect them back to the login page
                            $this->session->set_flashdata('message', $this->ion_auth->errors());
                            redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
                    }
            }
            else
            {  //the user is not logging in so display the login page
                    //set the flash data error message if there is one
                    $page['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                    $page['email'] = array('name' => 'email',
                            'id' => 'email',
                            'type' => 'text',
                            'value' => $this->form_validation->set_value('email'),
                    );
                    $page['password'] = array('name' => 'password',
                            'id' => 'password',
                            'type' => 'password',
                    );

                    $page['content'] = 'auth/login';
                    $this->load->view('template', $page);
            }
    }

    //log the user out
    function logout()
    {
            $this->data['title'] = "Logout";

            //log the user out
            $logout = $this->ion_auth->logout();

            //redirect them to the homepage
            redirect($this->config->item('base_url'), 'refresh');
    }

    //change password
    function change_password()
    {
        $page = $this->page;
        
        $this->form_validation->set_rules('old', 'Old password', 'required');
        $this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

        if (!$this->ion_auth->logged_in())
        {
                redirect('auth/login', 'refresh');
        }
        $user = $this->ion_auth->get_user($this->session->userdata('user_id'));

        if ($this->form_validation->run() == false)
        { //display the form
                //set the flash data error message if there is one
                $page['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $page['old_password'] = array('name' => 'old',
                        'id' => 'old',
                        'type' => 'password',
                );
                $page['new_password'] = array('name' => 'new',
                        'id' => 'new',
                        'type' => 'password',
                );
                $page['new_password_confirm'] = array('name' => 'new_confirm',
                        'id' => 'new_confirm',
                        'type' => 'password',
                );
                $page['user_id'] = array('name' => 'user_id',
                        'id' => 'user_id',
                        'type' => 'hidden',
                        'value' => $user->id,
                );

                $page['content'] = 'auth/change_password';
                $this->load->view('template', $page);
        }
        else
        {
                $identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

                $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

                if ($change)
                { //if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        $this->logout();
                }
                else
                {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('auth/change_password', 'refresh');
                }
        }
    }

    //forgot password
    function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        if ($this->form_validation->run() == false)
        {
                //setup the input
                $page['email'] = array('name' => 'email',
                        'id' => 'email',
                );
                //set any errors and display the form
                $page['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                $page['content'] = 'auth/forgot_password';
                $this->load->view('template', $page);
        }
        else
        {
                //run the forgotten password method to email an activation code to the user
                $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

                if ($forgotten)
                { //if there were no errors
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
                }
                else
                {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect("auth/forgot_password", 'refresh');
                }
        }
    }

    //reset password - final step for forgotten password
    public function reset_password($code)
    {
        $reset = $this->ion_auth->forgotten_password_complete($code);

        if ($reset)
        {  //if the reset worked then send them to the login page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth/login", 'refresh');
        }
        else
        { //if the reset didnt work then send them back to the forgot password page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
        }
    }

    //activate the user
    function activate($id, $code=false)
    {
        if ($code !== false)
                $activation = $this->ion_auth->activate($id, $code);
        else if ($this->ion_auth->is_admin())
                $activation = $this->ion_auth->activate($id);


        if ($activation)
        {
                //redirect them to the auth page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth", 'refresh');
        }
        else
        {
                //redirect them to the forgot password page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
        }
    }

    /**
     * Promote a member to Super User status
     */
    function promote($id=0)
    {
        // Make sure the input is valid
        if ($id == 0)
        {
            $this->session->set_flashdata('error', 'Error! No id provided.');
            redirect('auth', 'refresh');
        }
        
        // User must exist
        $user = $this->ion_auth_model->get_user($id)->row();
        if (!isset($user->id))
        {
            $this->session->set_flashdata('error', 'Error! The user does not exist.');
            redirect('auth', 'refresh');
        }
        
        // User must be a member
        if ($user->group_id != 2)
        {
            $this->session->set_flashdata('error', 'Error! Invalid group.');
            redirect('auth', 'refresh');
        }
        
        // Must be logged in and admin
        if ( !$this->ion_auth->logged_in() )
            redirect('auth', 'refresh');
        if ( !$this->ion_auth->is_admin() )
            redirect('auth', 'refresh');
        
        // Away we go
        $this->db->query('UPDATE users SET group_id=3 WHERE id='.$id);
        
        // redirect them back to the auth page
        $this->session->set_flashdata('notice', 'User promoted to Super User.');
        redirect('auth', 'refresh');
        
    }  // end promote
    
    //deactivate the user
    function deactivate($id = NULL)
    {
        // no funny business, force to integer
        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', 'confirmation', 'required');
        $this->form_validation->set_rules('id', 'user ID', 'required|is_natural');

        if ($this->form_validation->run() == FALSE)
        {
            // insert csrf check
            $page['csrf'] = $this->_get_csrf_nonce();
            $page['user'] = $this->ion_auth->get_user_array($id);
            $page['content'] = 'auth/deactivate_user';
            $this->load->view('template', $page);
        }
        else
        {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes')
            {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
                {
                    show_404();
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
                {
                    $this->ion_auth->deactivate($id);
                }
            }

            //redirect them back to the auth page
            redirect('auth', 'refresh');
        }
    }

    //create a new user
    function create_user()
    {
        
        $page = $this->page;
        $this->data['title'] = "Create User";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

        //validate form input
        $this->form_validation->set_rules('username', 'User Name', 'required|min_length[5]');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');

        if ($this->form_validation->run() == true)
        {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');


        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
        { //check to see if we are creating the user
            //redirect them back to the admin page
            $this->session->set_flashdata('message', "User Created");
            redirect("auth", 'refresh');
        }
        else
        { //display the create user form
            //set the flash data error message if there is one
            $page['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $page['username'] = array('name' => 'username',
                    'id' => 'username',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('username'),
            );
            $page['email'] = array('name' => 'email',
                    'id' => 'email',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('email'),
            );
            $page['password'] = array('name' => 'password',
                    'id' => 'password',
                    'type' => 'password',
                    'value' => $this->form_validation->set_value('password'),
            );
            $page['password_confirm'] = array('name' => 'password_confirm',
                    'id' => 'password_confirm',
                    'type' => 'password',
                    'value' => $this->form_validation->set_value('password_confirm'),
            );

            $page['content'] = 'auth/create_user';
            $this->load->view('template', $page);
        }
    }

    function _get_csrf_nonce()
    {
            $this->load->helper('string');
            $key = random_string('alnum', 8);
            $value = random_string('alnum', 20);
            $this->session->set_flashdata('csrfkey', $key);
            $this->session->set_flashdata('csrfvalue', $value);

            return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
            if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
            {
                    return TRUE;
            }
            else
            {
                    return FALSE;
            }
    }

    function _usernameavailable($username)
    {
        if ( isset($this->ion_auth->get_user_by_username($username)->id) )
        {
            $this->form_validation->set_message('_usernameavailable', 'That username is not available sorry.');
            return false;

        }
        else
            return true;
    }

    function _emailavailable($email)
    {
        if ( isset($this->ion_auth->get_user_by_email($email)->id) )
        {
            $this->form_validation->set_message('_emailavailable', 'That email is already registered.');
            return false;

        }
        else
            return true;
    }

}

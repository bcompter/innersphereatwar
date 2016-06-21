<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('validate_exists'))
{
    /**
     * Validate that a variable exists
     * @param type $var         The variable to test
     * @param type $error_msg   Error message to display
     * @param type $redirect    Redirect path
     * @param type $view        View to display if not a redirect
     * @return boolean          True if $var exists (is not null), false otherwise
     */
    function validate_exists($var, $error_msg=0, $redirect=0, $view=0)
    {
        if (!isset($var))
        {
            $CI =& get_instance();
            if ($redirect !== 0)
            {
                $CI->session->set_flashdata('error', $page['error']);
                $CI->redirect($redirect, 'refresh');
            }
            else if ($view !== 0)
            {
                $error_msg !== 0 ? $page['error'] = $error_msg : $page['error'] = 'Error!';
                $CI->load->view($view, $page);
            }
            return false;
        }
        return true;
    }
}

if ( ! function_exists('validate_matches'))
{
    /**
     * Validate that a variable matches another
     * @param type $varA        The first variable to test
     * @param type $varB        The second variable to test
     * @param type $error_msg   Error message to display
     * @param type $redirect    Redirect path
     * @param type $view        View to display if not a redirect
     * @return boolean          True if $varA matches $varB, false otherwise
     */
    function validate_matches($varA, $varB, $error_msg=0, $redirect=0, $view=0)
    {
        if ($varA != $varB)
        {
            $CI =& get_instance();
            if ($redirect !== 0)
            {
                $CI->session->set_flashdata('error', $page['error']);
                $CI->redirect($redirect, 'refresh');
            }
            else if ($view !== 0)
            {
                $error_msg !== 0 ? $page['error'] = $error_msg : $page['error'] = 'Error!';
                $CI->load->view($view, $page);
            }
            return false;
        }
        return true;
    }
}

if ( ! function_exists('validate_not_match'))
{
    /**
     * Validate that a variable does not match another
     * @param type $varA        The first variable to test
     * @param type $varB        The second variable to test
     * @param type $error_msg   Error message to display
     * @param type $redirect    Redirect path
     * @param type $view        View to display if not a redirect
     * @return boolean          True if $varA does not match $varB, false otherwise
     */
    function validate_not_match($varA, $varB, $error_msg=0, $redirect=0, $view=0)
    {
        if ($varA == $varB)
        {
            $CI =& get_instance();
            if ($redirect !== 0)
            {
                $CI->session->set_flashdata('error', $page['error']);
                $CI->redirect($redirect, 'refresh');
            }
            else if ($view !== 0)
            {
                $error_msg !== 0 ? $page['error'] = $error_msg : $page['error'] = 'Error!';
                $CI->load->view($view, $page);
            }
            return false;
        }
        return true;
    }
}
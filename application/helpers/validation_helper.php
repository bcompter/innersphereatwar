<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('validate_exists'))
{
    function validate_exists($var, $error_msg=0)
    {
        if (!isset($var))
        {
            set_error($error_msg);
            return false;
        }
        return true;
    }
}

if ( ! function_exists('validate_matches'))
{
    function validate_matches($varA, $varB, $error_msg=0)
    {
        if ($varA != $varB)
        {
            set_error($error_msg);
            return false;
        }
        return true;
    }
}

if ( ! function_exists('set_error'))
{
    function set_error($error_msg)
    {
        if ($error_msg !== 0)
        {
            $page['error'] = $error_msg;
        }
        else
        {
            $page['error'] = 'Error!';
        }
        $CI =& get_instance();
        $CI->session->set_flashdata('error', $page['error']);
    }
}
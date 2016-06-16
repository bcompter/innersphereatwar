<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('validate_exists'))
{
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
                $CI->load->view($view);
                if ($error_msg !== 0)
                {
                    $page['error'] = $error_msg;
                }
                else
                {
                    $page['error'] = 'Error!';
                }
            }
            return false;
        }
        return true;
    }
}

if ( ! function_exists('validate_matches'))
{
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
                if ($error_msg !== 0)
                {
                    $page['error'] = $error_msg;
                }
                else
                {
                    $page['error'] = 'Error!';
                }
                $CI->load->view($view);
            }
            return false;
        }
        return true;
    }
}
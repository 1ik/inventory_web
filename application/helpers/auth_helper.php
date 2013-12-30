<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if (!function_exists('logged_in'))
{
    function logged_in()
    {
    	$CI =& get_instance();
        if(!$CI->ion_auth->is_admin()) {
        	redirect('auth');
        } else {
        	//do nothing. let him FTW
        }
    }
}
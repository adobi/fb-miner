<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once(BASEPATH.'core/Controller'.EXT);

class Admin_Controller extends CI_Controller 
{
    //php 5 constructor
    public function __construct() 
    {
        parent::__construct();
        
        if ($this->uri->segment(1) !== 'auth' && !$this->session->userdata('current_user_id')) {
            
            if ((array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')) {
                
                echo '<script type="text/javascript">location.reload();</script>';
                die;
            }            
            
            redirect(base_url() . 'auth/login');
        }
        
       
    }
}

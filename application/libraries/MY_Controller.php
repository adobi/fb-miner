<?php 

if (! defined('BASEPATH')) exit('No direct script access');

#require_once(BASEPATH.'core/Controller'.EXT);


class MY_Controller extends CI_Controller 
{
    //php 5 constructor
    public function __construct() 
    {
        parent::__construct();
        
        if ($this->uri->segment(1) !== 'auth' && !$this->session->userdata('current_user_id')) {
            
            //redirect(base_url() . 'auth/login');
        }
        
       
    }
}

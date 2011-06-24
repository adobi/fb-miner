<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'Admin_Controller.php';

class Admin extends Admin_Controller 
{   
    public function index()
    {
        $data = array();
        
        $this->template->build('admin/index', $data);
    }
    
    
    
}
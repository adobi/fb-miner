<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'Admin_Controller.php';

class Auth extends Admin_Controller 
{   
    
    public function __construct()
    {
        parent::__construct();
    }
        
    public function index()
    {
        redirect(base_url() . 'auth/login');
    }
    
    public function login() 
    {
        $this->form_validation->set_rules('username', 'Felhasználónév', 'trim|required|callback_check_credentials');
        $this->form_validation->set_rules('password', 'Jelszó', 'trim|required');
        
        if ($this->form_validation->run()) {
            
            redirect(base_url() . 'admin/mine');
        }
        
        $this->template->build('auth/login');
    }
    
    public function check_credentials() 
    {
        $this->load->model('Admins', 'users');
        
        $user = $this->users->login($_POST['username'], md5($_POST['password']));
        
        if ($user) {
            
            $this->session->set_userdata('current_user_id', $user->id);
            
            return true;
        }
        
        $this->form_validation->set_message('check_credentials', 'Nincs ilyen felhasználó');
        return false;
    }
    
    public function logout()
    {
        //$this->session->set_user_data('current_user_id', false);
        
        $this->session->unset_userdata('current_user_id');
        
        $this->session->sess_destroy();
        
        redirect(base_url() . 'game');
    }

}

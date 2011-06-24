<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'Admin_Controller.php';

class Shopmanager extends MY_Controller 
{
    public function index() 
    {
        $data = array();
        
        $this->load->model('', '');
        
        $this->template->build('/index', );
    }
    
    public function edit() 
    {
        $data = array();
        
        $id = $this->uri->segment(3);
        
        $this->load->model('', 'model');
        
        $item = false;
        if ($id) {
            $item = $this->model->find((int)$id);
        }
        $data['current_item'] = $item;
        
        if ($this->form_validation->run()) {
        
            if ($id) {
                $this->model->update($_POST, $id);
            } else {
                $this->model->insert($_POST);
            }
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($_POST) {
                
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        
        $this->template->build('/edit', $data);
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            $this->load->model('', 'model');
            
            $this->model->delete($id);
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
}
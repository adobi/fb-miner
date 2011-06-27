<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'Admin_Controller.php';

class Minemanager extends Admin_Controller 
{
    public function index() 
    {
        $data = array();
        
        $this->load->model('Mineitems', 'items');
        
        $data['items'] = $this->items->fetchAll();
        
        $this->load->model('Mines', 'mines');
        
        $data['mines'] = $this->mines->fetchAllWithItems();
        
        $this->template->build('minemanager/index', $data);
    }
    
    public function edit() 
    {
        $data = array();
        
        $id = $this->uri->segment(3);
        
        $this->load->model('Mines', 'model');
        
        $item = false;
        if ($id) {
            $item = $this->model->find((int)$id);
        }
        $data['current_item'] = $item;
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        
        if ($this->form_validation->run()) {
        
            if ($id) {
                $this->model->update($_POST, $id);
            } else {
                $this->model->insert($_POST);
            }
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($_POST) {

    	        $this->session->set_userdata('validation_error',validation_errors());
    	        $this->session->set_userdata('current_dialog_item', (is_numeric($id) ? $id : -1));                
                
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        
        $this->template->build('minemanager/edit', $data);
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            $this->load->model('Mines', 'model');
            
            $this->model->delete($id);
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function add_item_to()
    {
        $mine = $this->uri->segment(3);
        
        $data = array();
        
        $this->load->model('Mineitems', 'items');
        
        $data['items'] = $this->items->toAssocArray('id', 'name', $this->items->fetchAll());
        
        $this->form_validation->set_rules('mine_item_id', 'Mine item', 'trim|required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
        
        if ($this->form_validation->run()) {
            
            if ($mine) {
                
                $this->load->model('Minehasitems', 'mineitems');
                
                $_POST['mine_id'] = $mine;
                
                $this->mineitems->insert($_POST);
            }
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($_POST) {

    	        $this->session->set_userdata('validation_error',validation_errors());
    	        $this->session->set_userdata('current_dialog_item', (is_numeric($id) ? $id : -1));                
                
                redirect($_SERVER['HTTP_REFERER']);
            }
        }        
        
        $this->template->build('minemanager/add_item_to', $data);
    }
    
    public function items_of()
    {
        $mine = $this->uri->segment(3);
        
        $data = array();
        
        $this->load->model('Minehasitems', 'mineitems');
        
        $data['items'] = $this->mineitems->fetchForMine($mine);
        
        $this->template->build('minemanager/items_of', $data);
    }
    
    public function delete_item()
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            $this->load->model('Minehasitems', 'model');
            
            $item = $this->model->find($id);
            
            $this->model->delete($id);
            
            $this->session->set_userdata("current_mine_item", $item->mine_id);
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function update_item() 
    {
        $id = $this->uri->segment(3);
        
        if ($_POST) {
            
            $this->load->model('Minehasitems', 'mineitems');
            
            $this->mineitems->update($_POST, $id);
        }
    }    
}
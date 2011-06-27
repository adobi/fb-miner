<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'Admin_Controller.php';

class Shopmanager extends Admin_Controller 
{
    public function index() 
    {
        $data = array();
        
        $this->load->model('Shopitemtypes', 'types');
        
        $data['types'] = $this->types->fetchAll();        
        
        $this->load->model('Shopitems', 'items');
        
        $data['items'] = $this->items->fetchAllWithType($this->uri->segment(3));
        
        $this->load->model('Shops', 'shops');
        
        $data['shops'] = $this->shops->fetchAll();
        
        $this->load->model('Shophasitems', 'shopitems');
        $data['shop_items'] = $this->shopitems->fetchForShop($data['shops'][0]->id);        

        $this->template->build('shopmanager/index', $data);
    }
    
    public function edit() 
    {
        $data = array();
        
        $id = $this->uri->segment(3);
        
        $this->load->model('Shops', 'model');
        
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
        
        $this->template->build('shopmanager/edit', $data);
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
    
    public function add_item_to()
    {
        $shop = $this->uri->segment(3);
        
        $data = array();
        
        $this->load->model('Shopitems', 'items');
        
        $items = $this->items->fetchAllNotInShop($shop);
        $data['items'] = $this->items->toAssocArray('id', 'name', $items);
        if (!$items) {
            
            echo '<div class = "error">No available items</div>'; 
            die;
        }
        
        $this->form_validation->set_rules('shop_item_id', 'Shop item', 'trim|required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
        
        if ($this->form_validation->run()) {
            
            if ($shop) {
                
                $this->load->model('Shophasitems', 'shopitems');
                
                $_POST['shop_id'] = $shop;
                
                $this->shopitems->insert($_POST);
            }
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($_POST) {

    	        $this->session->set_userdata('validation_error',validation_errors());
    	        $this->session->set_userdata('current_dialog_item', (is_numeric($id) ? $id : -1));                
                
                redirect($_SERVER['HTTP_REFERER']);
            }
        }        
        
        $this->template->build('shopmanager/add_item_to', $data);
        
    }

    public function items_of()
    {
        $shop = $this->uri->segment(3);
        
        $data = array();
        
        $this->load->model('Shophasitems', 'shopitems');
        
        $data['items'] = $this->shopitems->fetchForShop($shop);
        
        $this->template->build('shopmanager/items_of', $data);
    } 
    
    public function delete_item()
    {
        $id = $this->uri->segment(3);
        
        if ($id) {
            $this->load->model('Shophasitems', 'model');
            
            $item = $this->model->find($id);
            
            $this->model->delete($id);
            
            $this->session->set_userdata("current_shop_item", $item->shop_id);
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    } 
    
    public function update_item() 
    {
        $id = $this->uri->segment(3);
        
        if ($_POST) {
            
            $this->load->model('Shophasitems', 'shopitems');
            
            $this->shopitems->update($_POST, $id);
        }
        
        die;
    }      
}
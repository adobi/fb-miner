<?php 

if (! defined('BASEPATH')) exit('No direct script access');

require_once 'Game_Controller.php';

class Game extends Game_Controller 
{
    //php 5 constructor
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function start()
    {
        
    }
    
    public function index() 
    {
        $data = array();
        
        $this->load->model('Users', 'users');
        
        $this->session->set_userdata('player', $this->users->find(1));
        
        $this->template->build('game/index', $data);
    }
    
    public function main()
    {
        $data = array();
        
        $this->load->model('Usermines', 'mines');
        $data['mines'] = $this->mines->fetchForUser($this->session->userdata('player')->id);
        
        $this->load->model('Usershopitems', 'shopitems');
        $data['items'] = $this->shopitems->fetchForUser($this->session->userdata('player')->id);
        
        $this->template->build('game/main', $data);        
    }    
    
    public function map()
    {
        $id = $this->uri->segment(3);
        
        $data = array();
        
        $this->load->model('Usermines', 'mines');
        
        $data['mine'] = $this->mines->fetchMine($id);
        
        //dump($data);
        
        $this->template->build('game/map', $data);
    }
    
    public function startmining() 
    {
        $mineHasItemId = $this->uri->segment(3);
        
        $this->load->model('Minehasitems', 'mineitems');
        
        $selectedItem = $this->mineitems->find($mineHasItemId);
        
        $response = array();
        
        if ($selectedItem) {
            
            $isPending = $this->session->userdata('pending_mine') && $this->session->userdata('pending_item');
            
            if ($isPending) {
                
                $response['code'] = 0;
                $response['message'] = '<p>You already hava a pending operation, please first wait that</p>';
                
            } else {
                
                $this->session->set_userdata('pending_mine', $selectedItem->mine_id);
                $this->session->set_userdata('pending_item', $selectedItem->mine_item_id);
                
                /**
                 * felvenni a tablaba
                 *
                 * @author Dobi Attila
                 */
                
                $response['code'] = 1;
                $response['message'] = '<p>You started mining, please wait come back after x minutes</p>';
            }
        } else {
            
            $response['code'] = -1;
            $response['message'] = '<p>There is no item in this mine</p>';
        }
        
        echo json_encode($response);
        die;
    }

}
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
        
        $this->load->model('Mines', 'mines');
        $data['mines'] = $this->mines->fetchFree();
        
        $this->load->model('Shopitems', 'shopitems');
        //$data['items'] = $this->shopitems->fetchFree();
        
        $this->template->build('game/index', $data);
    }

}
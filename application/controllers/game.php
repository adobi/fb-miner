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

    
    public function index() 
    {
        $data = array();
        
        $this->template->build('game/index', $data);
    }

}
<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Mines extends MY_Model 
{
    protected $_name = "mine";
    protected $_primary = "id";
    
    public function fetchAllWithItems()
    {
        $mines = $this->fetchAll();
        
        if ($mines) {
            $this->load->model('Minehasitems', 'mineitems');
            
            foreach ($mines as $mine) {
                
                $mine->items = $this->mineitems->fetchForMine($mine->id);
            }
        }
        
        return $mines;
    }
    
    public function fetchFree()
    {
        return $this->fetchRows(
            array('where'=>array('is_free'=>1))    
        );
    }
}
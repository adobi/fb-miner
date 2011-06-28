<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Usermines extends MY_Model 
{
    protected $_name = "user_mine";
    protected $_primary = "id";
    
    public function fetchForUser($userId)
    {
        if (!$userId) {
            
            return false;
        }
        
        $result = $this->fetchRows(
            array(
                'join'=>array(
                    array('table'=>'mine', 'condition'=>'mine.id = user_mine.mine_id', 'columns'=>array('mine.name'))
                ),
                'where'=>array('user_id'=>$userId)
            )  
        );
        
        return $result;
    }
    
    public function fetchMine($mineId) 
    {
        if (!$mineId) {
            
            return false;
        }
        
        $result = $this->fetchRows(
            array(
                'join'=>array(
                    array('table'=>'mine m', 'condition'=>'m.id = user_mine.mine_id', 'columns'=>array('m.name as mine_name'))
                ),
                'where'=>array('user_mine.id'=>$mineId)    
            ), true
        );
        
        if ($result) {
            
            $this->load->model('Minehasitems', 'mineitems');
            
            $result->items = $this->mineitems->fetchForMine($mineId);
        }
        
        //dump($result);
        
        return $result;
    }
}
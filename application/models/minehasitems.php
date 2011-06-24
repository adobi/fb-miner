<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Minehasitems extends MY_Model 
{
    protected $_name = "mine_has_item";
    protected $_primary = "id";
    
    public function fetchForMine($mine) 
    {
        if (!$mine) {
            
            return false;
        }
        
        $result = $this->fetchRows(
            array(
                'join'=>array(
                    array('table'=>'mine_item', 'condition'=>'mine_has_item.mine_item_id = mine_item.id', 'columns'=>array('mine_item.name'))  
                ),
                'where'=>array('mine_has_item.mine_id'=>$mine)    
            )
        );
        
        return $result;
    }
}
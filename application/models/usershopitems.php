<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Usershopitems extends MY_Model 
{
    protected $_name = "user_has_shop_item";
    protected $_primary = "id";

    public function fetchForUser($userId)
    {
        if (!$userId) {
            
            return false;
        }
        
        $result = $this->fetchRows(
            array(
                'join'=>array(
                    array('table'=>'shop_item', 'condition'=>'shop_item.id = user_has_shop_item.shop_item_id', 'columns'=>array('shop_item.name as item_name')),
                    array('table'=>'shop_item_type', 'condition'=>'shop_item.shop_item_type_id = shop_item_type.id', 'columns'=>array('shop_item_type.name as item_type'))
                ),
                'where'=>array('user_id'=>$userId)
            )  
        );
        //dump($result); die;
        return $result;
    }
    
    public function fetchToolsForUser($userId)
    {
        if (!$userId) {
            
            return false;
        }
        
        $result = $this->fetchRows(
            array(
                'join'=>array(
                    array('table'=>'shop_item', 'condition'=>'shop_item.id = user_has_shop_item.shop_item_id', 'columns'=>array('shop_item.name as item_name, shop_item.speed as speed')),
                    array('table'=>'shop_item_type', 'condition'=>'shop_item.shop_item_type_id = shop_item_type.id', 'columns'=>array('shop_item_type.name as item_type'))
                ),
                'where'=>array('user_id'=>$userId, 'shop_item.shop_item_type_id = 2'=>null)
            )  
        );
        //dump($result); die;
        return $result;
    }
    
    public function find($id)
    {
        if (!$id) {
            
            return false;
        }
        
        $result = $this->fetchRows(
            array(
                'join'=>array(
                    array('table'=>'shop_item', 'condition'=>'shop_item.id = user_has_shop_item.shop_item_id', 'columns'=>array('shop_item.name as item_name, shop_item.speed as speed')),
                ),
                'where'=>array('user_has_shop_item.id'=>$id)
            ), true
        );
        
        return $result;
    }
    
}
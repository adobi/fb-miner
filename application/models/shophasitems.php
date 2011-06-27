<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Shophasitems extends MY_Model 
{
    protected $_name = "shop_has_item";
    protected $_primary = "id";
    
    public function fetchForShop($shop) 
    {
        if (!$shop) {
            
            return false;
        }
        
        $result = $this->fetchRows(
            array(
                'join'=>array(
                    array('table'=>'shop_item', 'condition'=>'shop_has_item.shop_item_id = shop_item.id', 'columns'=>array('shop_item.name', 'shop_item.price', 'shop_item.fb_coin_price')),
                    array('table'=>'shop_item_type', 'condition'=>'shop_item_type.id = shop_item.shop_item_type_id', 'columns'=>array('shop_item_type.name as item_type'))  
                ),
                'where'=>array('shop_has_item.shop_id'=>$shop)    
            )
        );
        
        return $result;
    }    
}
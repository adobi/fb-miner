<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Shopitems extends MY_Model 
{
    protected $_name = "shop_item";
    protected $_primary = "id";
    
    public function fetchAllWithType($type)
    {
        if (!$type) {
                
            $result = $this->fetchAll(
                array(
                    'join'=>array(
                        array('table'=>'shop_item_type', 'condition'=>'shop_item.shop_item_type_id = shop_item_type.id', 'columns'=>array('shop_item_type.name as type_name'))
                    )    
                )
            );
        } else {
            
            $result = $this->fetchRows(
                array(
                    'join'=>array(
                        array('table'=>'shop_item_type', 'condition'=>'shop_item.shop_item_type_id = shop_item_type.id', 'columns'=>array('shop_item_type.name as type_name'))
                    ),
                    'where'=>array('shop_item.shop_item_type_id'=>$type)
                )
            );
        }
        return $result;
    }
    
    public function fetchAllNotInShop($shop) 
    {
        if (!$shop) {
            
            return false;
        }
        
        $result = $this->execute("select * from shop_item where id not in (select shop_item_id from shop_has_item where shop_id = $shop)");
        
        return $result;
    }
}
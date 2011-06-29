<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Usermineditemslog extends MY_Model 
{
    protected $_name = "user_mined_item_log";
    protected $_primary = "id";
    
    public function fetchMineItem($id)
    {
        if (!$id) {
            
            return false;
        }
        
        $result = $this->fetchRows(
            array(
                'join'=>array(
                    array('table'=>'mine_has_item mhi', 'condition'=>'mhi.id = user_mined_item_log.mine_has_item_id', 'columns'=>array('mhi.quantity as quantity')),
                    array('table'=>'mine_item mi', 'condition'=>'mi.id = mhi.mine_item_id', 'columns'=>array('mi.price as price'))  
                ),
                'where'=>array('user_mined_item_log.id'=>$id)
            ), true
        );
        
        return $result;
    }
    
    /**
     * adott userhez megnezi, hogy van e neki folyamatban levo banyaszasa
     *
     * @param string $userId 
     * @return void
     * @author Dobi Attila
     */
    public function fetchCurrentMiningForUser($userId)
    {
        if (!$userId) {
            
            return false;
        }
        
        $result = $this->fetchRows(
            array(
                'join'=>array(
                    array('table'=>'mine_has_item mhi', 'condition'=>'mhi.id = user_mined_item_log.mine_has_item_id', 'columns'=>array('mhi.mine_id, mhi.mine_item_id')),
                ),
                'where'=>array('user_id' =>$userId, 'finished >= '=>date('Y-m-d H:i:s'))
            ), true
        );
        
        return $result;
    }
}
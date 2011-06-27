<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class User extends MY_Model 
{
    protected $_name = "user";
    protected $_primary = "id";
    
    public function initUser($facebookId)
    {
        if (!$facebookId) {
            
            return false;
        }
    }
}
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
    
    /**
     * az aktualis user-t kivalasztjuk, illetve megnezzuk, hogy van a folyamatban levo banyaszas. 
     * ha van akkor kiirjuk a kovetkezo banyaszas idejet
     *
     * @return void
     * @author Dobi Attila
     */
    public function index() 
    {
        $data = array();
        
        $this->load->model('Users', 'users');
        
        $this->session->set_userdata('player', $this->users->find(1));
        
        $this->load->model('Usermineditemslog', 'mined');
        $currentMining = $this->mined->fetchCurrentMiningForUser($this->session->userdata('player')->id); 
        $data['next_mining_time'] = false;
        if ($currentMining) {
            
            $data['next_mining_time'] = $currentMining->finished;
        }
        
        $this->template->build('game/index', $data);
    }
    
    /**
     * listazzuk a banayakat illeve a felhasznalo osszes itemet, eszkoz, kaja, ruha
     *
     * @return void
     * @author Dobi Attila
     */
    public function main()
    {
        $data = array();
        
        $this->load->model('Usermines', 'mines');
        $data['mines'] = $this->mines->fetchForUser($this->session->userdata('player')->id);
        
        $this->load->model('Usershopitems', 'shopitems');
        $data['items'] = $this->shopitems->fetchForUser($this->session->userdata('player')->id);
        
        $this->template->build('game/main', $data);        
    }    
    
    /**
     * listazzuk az adott banya tartalmat, es az osszes eszkozt amivel banyaszni lehet
     *
     * @return void
     * @author Dobi Attila
     */
    public function mine()
    {
        $id = $this->uri->segment(3);
        
        $data = array();
        
        $this->load->model('Usermines', 'mines');
        
        $data['mine'] = $this->mines->fetchMine($id);
        
        $this->load->model('Usershopitems', 'shopitems');
        $data['tools'] = $this->shopitems->fetchToolsForUser($this->session->userdata('player')->id);
        
        $this->template->build('game/mine', $data);
    }
    
    /**
     * elkezd egy banyaszast
     *
     * @return void
     * @author Dobi Attila
     */
    public function startmining() 
    {
        $mineHasItemId = $this->uri->segment(3);
        $tool = $this->uri->segment(5);
        
        $this->load->model('Minehasitems', 'mineitems');
        $selectedItem = $this->mineitems->find($mineHasItemId);
        
        $this->load->model('Usershopitems', 'shopitems');
        $selectedTool = $this->shopitems->find($tool);
        
        $response = array();
        
        // ha volt kivalasztva banya item es eszkoz
        if ($selectedItem && $selectedTool) {
            
            $isPending = $this->session->userdata('pending_mine') && $this->session->userdata('pending_item');
            
            // van e folyamatban levo banyaszas, ha igen akkor hiba
            if ($isPending) {
                
                $response['code'] = 0;
                $response['message'] = '<p>You already hava a pending operation, please first wait that</p>';
                
            } else {
                
                $now = time();
                $format = 'Y-m-d H:i:s';
                
                $this->load->model('Usermineditemslog', 'mined'); 
                
                // mennyiseg * egyszeg banyaszasi ideje
                $finished = date($format, $now+$selectedItem->quantity * $selectedTool->speed);
                
                //felvisszuk a tablaba az uj folyamatot
                $inserted = $this->mined->insert(array(
                    'user_id'=>$this->session->userdata('player')->id,
                    'mine_has_item_id'=>$mineHasItemId,
                    'started'=>date($format, $now),
                    'finished'=>$finished,
                    'users_item_id'=>$tool   
                ));
                
                // ha sikeres volt a beszuras
                if ($inserted) {
                    // melyik banya az aktualis
                    $this->session->set_userdata('pending_mine', $selectedItem->mine_id); 
                    // melyik item az aktualis
                    $this->session->set_userdata('pending_item', $selectedItem->mine_item_id);
                    // melyik banya item az aktualis
                    $this->session->set_userdata('pending_mine_item', $mineHasItemId);
                    // melyik tool az aktualis
                    $this->session->set_userdata('pending_tool', $tool);
                    // aktualis folyamat id-ja
                    $this->session->set_userdata('current_mining', $inserted);
                    
                    $response['next_mining_time'] = $finished;
                    $response['code'] = 1;
                    $response['message'] = '<p>You started mining, please wait come back at '.$finished.'</p>';
                } else {
                    
                    $response['code'] = 0;
                    $response['message'] = '<p>There was a problem, try again later :(</p>';
                }
                
            }
        } else {
            
            $response['code'] = -1;
            $response['message'] = '<p>There is no item in this mine</p>';
        }
        
        echo json_encode($response);
        die;
    }
    
    /**
     * 10 masodpercenkent lefut es ellnorzi, hogy tart e meg a banyaszas
     *
     * @return void
     * @author Dobi Attila
     */
    public function check()
    {
        $data = array();
        
        $this->load->model('Usermineditemslog', 'mined');
        
        // sessionben van e aktualis folyamat (a bongeszo ablak nem lett bezarva a banyaszas kezdese ota)
        if ($this->session->userdata('current_mining')) {
            
            $currentMining = $this->mined->find($this->session->userdata('current_mining'));
            
            // van aktialis folyamat, ha lejart
            if ($currentMining && strtotime($currentMining->finished) <= time()) {
                
                // toroljuk a sessiont
                $this->session->unset_userdata('pending_mine');
                $this->session->unset_userdata('pending_item');
                $this->session->unset_userdata('current_mining');
                $this->session->unset_userdata('pending_mine_item');
                $this->session->unset_userdata('pending_tool');
                
                $data['code'] = 1;
                
                $minedItem = $this->mined->fetchMineItem($currentMining->id);
                
                $this->load->model('Users', 'user');
                // frissitjuk a user penzet
                $cash = $this->session->userdata('player')->cash + ($minedItem->quantity*$minedItem->price);
                $this->user->update(array('cash'=>$cash), $this->session->userdata('player')->id);
                
                $data['cash'] = $cash;
                
                $data['message'] = 'Your mnining has been finished, now you can start another one';
                
                // TODO nullazni kell az adott banya adott itemjenek a mennyiseget a mine_has_item tablaban
                
            } else {
                
                // nincs folyamat, szemet maradt a sessionben
                if (!$currentMining) {
                    
                    $this->session->unset_userdata('pending_mine');
                    $this->session->unset_userdata('pending_item');
                    $this->session->unset_userdata('current_mining');
                    $this->session->unset_userdata('pending_mine_item');
                    $this->session->unset_userdata('pending_tool');
                } else {
                    $data['next_mining_time'] = $currentMining->finished;
                }
                
                $data['code'] = -1;
            }
        } else {
            
            // megkeressuk az adatbazisban, hogy van e olyan ami meg folyamatban van
            $currentMining = $this->mined->fetchCurrentMiningForUser($this->session->userdata('player')->id); 
            
            // ha van
            if ($currentMining) {
                
                // beallitjuk a sessiont
                $this->session->set_userdata('pending_mine', $currentMining->mine_id);
                $this->session->set_userdata('pending_item', $currentMining->mine_item_id);
                $this->session->set_userdata('pending_mine_item', $currentMining->mine_has_item_id);
                $this->session->set_userdata('pending_tool', $currentMining->users_item_id);
                $this->session->set_userdata('current_mining', $currentMining->id);
            } else {
                $data['code'] = 0;
            }
        }
        
        echo ';Game.OnCheckFinished('.json_encode($data).')'; 
        
        die;
    }
    
    public function shop()
    {
        $data = array();
        
        $this->load->model('Shophasitems', 'shopitems');
        $this->load->model('Shops', 'shop');
        $this->load->model('Shopitemtypes', 'types');
        
        $shop = $this->shop->fetchAll();
        $types = $this->types->fetchAll();
        
        $items = array();
        if ($types) {
            
            foreach ($types as $type) {
                
                $items[$type->name] = $this->shopitems->fetchForShopByType($shop[0]->id, $type->id);
            }
        }
        $data['shopitems'] = $items;
        
        $currentUser = $this->session->userdata('player');
        $this->template->build('game/shop', $data);
    }

}
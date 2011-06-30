
<div class="span-19"  style="margin-bottom:10px;">
    <div class="span-19">
        <div class = "game-button-bg">
            <div class = "game-button"  style="font-size:1.3em; padding-top:8px;">
                You have <span id = "player-cash"><?= $this->session->userdata('player')->cash ?></span> <img src="<?= base_url() ?>img/coin.png" alt="" style = "position:relative; top:3px"/>
            </div>
        </div>
        <div  class="game-button-bg"  style="float:right;">
            <a href="<?= base_url() ?>game/shop" id = "play-the-game"  class="change-screen game-button">Enter the shop</a>
        </div>
         
        <div  class="span-18 <?= $next_mining_time ? '' : 'hidden' ?>"  style="text-align:right;" id = "next-mining-notification">
            Next mining time: <span id = "next-mining-time"><?= $next_mining_time ? $next_mining_time : '' ?></span> 
        </div>
        
    </div>
</div>

<div class = "game-canvas-main span-19" style="margin:0px;"></div>

<a href="<?= base_url() ?>game/main" class = "change-screen hidden" id = "back-to-main">back to main page</a>
<br />
<a href="" class = "change-screen" id = "reload">reload</a>


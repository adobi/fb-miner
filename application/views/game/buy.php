
<fieldset class="round" style="width:550px;">
    
    <h3 style="margin-bottom:0px;">
        There are <span style="color:#000" id = "shop-max-quality"><?= $shopitem->quantity ?></span> pieces of <span style="color:#000"><?= $item->name ?></span> in the shop.<br />
    </h3>
    <?= form_open(base_url().'game/buy_item/'.$shopitem->shop_item_id) ?>
    <p  style="font-size:1.2em;">How much do you vant?</p> <input type="text" name = "quantity" id = "quantity" style="font-size:1.6em; padding:10px;">
    
    <div  class="game-button-bg">
        <a href="javascript:void(0);" class="change-screen game-button" id = "perfom-shopping">Buy</a>
    </div>
    <?= form_close(); ?>
</fieldset>
<p style="margin:0px">&nbsp;</p>


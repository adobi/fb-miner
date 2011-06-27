<fieldset class = "round">
    <?= form_open(); ?>
        <p>
            <label for="shop_item_type_id" class = "block">Shop item type</label>
            <?= form_dropdown('shop_item_type_id', $types, $current_item ? $current_item->shop_item_type_id : '') ?>
        </p>
        <p>
            <label for="name" class = "block">Name</label>
            <input type="text" name="name" value="<?= $current_item ? $current_item->name : '' ?>" id="name" />
        </p>
        <p>
            <label for="price" class = "block">Price</label>
            <input type="text" name = "price" value = "<?= $current_item ? $current_item->price  : ''?>" id = "price" /> $
        </p>
        <p>
            <label for="fb_coin_price" class = "block">Facebook coin price</label>
            <input type="text" name = "fb_coin_price" value = "<?= $current_item ? $current_item->fb_coin_price  : ''?>" id = "fb_coin_price" />
        </p>        
        <p>
            <button>Save</button>
        </p>
    <?= form_close(); ?>    
</fieldset>
<fieldset class="round" style = "width:300px;">
    <?= form_open() ?>
        <p>
            <label for="mine_item_id" class = "block">Mine item</label>
            <?= form_dropdown('mine_item_id', $items) ?>
        </p>
        <p>
            <label for="quantity" class="block">Quantity</label>
            <input type="text" name="quantity" value="" id="quantity" />
        </p>
        <p>
            <button>Save</button>
        </p>    
    <?= form_close() ?>
    
</fieldset>
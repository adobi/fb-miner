
<fieldset class="round">
    <?= form_open(); ?>
        <p>
            <label for="name" class = "block">Name</label>
            <input type="text" name="name" value="<?= $current_item ? $current_item->name : '' ?>" id="name" />
        </p>
        <p>
            <label for="price" class = "block">Price</label>
                <input type="text" name="price" value="<?= $current_item ? $current_item->price : '' ?>" id="price" size = "10"/> $ / unit
        </p>        
        <p>
            <button>Save</button>
        </p>
    <?= form_close(); ?>
</fieldset>    
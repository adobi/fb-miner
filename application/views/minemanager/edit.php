
<fieldset class="round">
    <?= form_open(); ?>
        <p>
            <label for="name" class = "block">Name</label>
            <input type="text" name="name" value="<?= $current_item ? $current_item->name : '' ?>" id="name" />
        </p>
        <p>
            <label for="is_free" class = "block">Is free</label>
            <input type="checkbox" value = "1" name = "is_free" <?= $current_item && $current_item->is_free ? 'checked = "checked"' : '' ?>/>
        </p>   
        <p>&nbsp;</p>        
        <p>
            <button>Save</button>
        </p>
    <?= form_close(); ?>
</fieldset>    
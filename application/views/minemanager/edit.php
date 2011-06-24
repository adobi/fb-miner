
<fieldset class="round">
    <?= form_open(); ?>
        <p>
            <label for="name" class = "block">Name</label>
            <input type="text" name="name" value="<?= $current_item ? $current_item->name : '' ?>" id="name" />
        </p>
        <p>
            <button>Save</button>
        </p>
    <?= form_close(); ?>
</fieldset>    
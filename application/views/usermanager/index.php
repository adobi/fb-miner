<fieldset  class="round">
    <legend>Users</legend>
    <p>
        <a href="<?= base_url() ?>usermanager/edit" rel = "dialog" title = "Add new user">add new user</a>
    </p>
    <?php if ($users): ?>
        <?php foreach ($users as $item): ?>
            <div class = "item span-4 round">
                <strong><?= $item->fb_id ?> - <?= $item->username ?></strong>
                <p>
                    <?= form_open(base_url() . 'usermanager/update/'.$item->id) ?>
                        Cash: <input type="text" name = "cash" value = "<?= $item->cash ?>" />
                    <?= form_close() ?>
                </p>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</fieldset>


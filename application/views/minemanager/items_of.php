
<fieldset  class="round span-9">
    <?php if ($items): ?>
        <?php foreach ($items as $item): ?>
            <div class = "item span-8 round">
                <strong><?= $item->name ?></strong> - quantity <strong><?= $item->quantity ?></strong>
                
                <p class = "text-right">
                    <a href="<?= base_url() ?>minemanager/delete_item/<?= $item->id ?>" class = "delete">delete</a>
                </p>
            </div>
        <?php endforeach ?>
    <?php else: ?>
        <em>no items</em>
    <?php endif ?>
    
</fieldset>
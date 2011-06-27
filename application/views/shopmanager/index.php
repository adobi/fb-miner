
<?php if ($this->session->userdata('validation_error')): ?>
    
    <div class = "error">
        <?= $this->session->userdata('validation_error'); ?>
    </div>    
    <?php 
        $this->session->unset_userdata('validation_error'); 
        //$this->session->unset_userdata('current_dialog_id');
    ?>
    
<?php endif ?>

<fieldset  class="round">
    <legend>Shop items types</legend>
    
    <p>
        <a href="<?= base_url() ?>shopitemtypemanager/edit" rel = "dialog" title = "Add new shop item type" dialog_id = "-3">add new shop item type</a>
    </p>
    
    <?php if ($types): ?>
        <?php foreach ($types as $item): ?>
            <div class = "item span-4 round">
                <strong><?= $item->name ?></strong>
                
                <p class = "text-right">
                    <a href="<?= base_url() ?>shopitemtypemanager/edit/<?= $item->id ?>" rel = "dialog" title = "Edit shop item type">edit</a>
                    <a href="<?= base_url() ?>shopitemtypemanager/delete/<?= $item->id ?>" class = "delete">delete</a>
                </p>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    
</fieldset>

<fieldset  class="round">
    <legend>Shop items</legend>
    
    <p>
        <a href="<?= base_url() ?>shopitemmanager/edit" rel = "dialog" title = "Add new shop item" dialog_id = "-2">add new shop item</a>
    </p>

    <?php if ($types): ?>
        <p style = "background:#ddd; padding:10px; margin-bottom:10px;" class = "round">
            <a href="<?= base_url() ?>shopmanager/"><strong>all</strong></a>
            <?php foreach ($types as $item): ?>
                <a href="<?= base_url() ?>shopmanager/index/<?= $item->id ?>"><?= $item->name ?></a>
            <?php endforeach ?>
        </p>
    <?php endif ?>

    
    <?php if ($items): ?>
        <?php foreach ($items as $item): ?>
            <div class = "item span-4 round <?= $item->fb_coin_price ? ' item-for-facebook-coin' : '' ?>">
                <strong><?= $item->name ?> - <?= $item->type_name ?></strong>
                
                <p class = "text-right">
                    <a href="<?= base_url() ?>shopitemmanager/edit/<?= $item->id ?>" rel = "dialog" title = "Edit shop item">edit</a>
                    <a href="<?= base_url() ?>shopitemmanager/delete/<?= $item->id ?>" class = "delete">delete</a>
                </p>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    
</fieldset>

<fieldset  class="round">
    <legend>Shops</legend>
    
    <p>
        <a href="<?= base_url() ?>shopmanager/edit" rel = "dialog" title = "Add new shop" dialog_id = "-1">add new shop</a>
    </p>
    
    <?php if ($shops): ?>
        <?php foreach ($shops as $item): ?>
            <div class = "item span-5 round">
                <strong><?= $item->name ?></strong>
                
                <p class = "text-right">
                    <a href="<?= base_url() ?>shopmanager/add_item_to/<?= $item->id ?>" rel = "dialog" title = "Add item to <?= $item->name ?>">add item</a>
                    <a href="<?= base_url() ?>shopmanager/items_of/<?= $item->id ?>" rel = "dialog" title = "<?= $item->name ?> items" dialog_id = "shop_<?= $item->id ?>">items</a>
                    <a href="<?= base_url() ?>shopmanager/edit/<?= $item->id ?>" rel = "dialog" title = "Edit mine <?= $item->name ?>">edit</a>
                    <a href="<?= base_url() ?>shopmanager/delete/<?= $item->id ?>" class = "delete">delete</a>
                </p>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    
</fieldset>

<?php if ($this->session->userdata('current_shop_item')): ?>
    <script type="text/javascript">
        $(function() {
            App.TriggerDialogOpen('shop_<?= $this->session->userdata("current_shop_item") ?>')
        });
        
    </script>
    <?php $this->session->unset_userdata('current_shop_item');   ?>
<?php endif ?>

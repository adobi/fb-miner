
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
                    <!-- <a href="<?= base_url() ?>shopitemtypemanager/delete/<?= $item->id ?>" class = "delete">delete</a> -->
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
        <p style = "background:#ededed; padding:10px; margin-bottom:10px;" class = "round">
            <a href="<?= base_url() ?>shopmanager/"><strong>all</strong></a>
            <?php foreach ($types as $item): ?>
                <a href="<?= base_url() ?>shopmanager/index/<?= $item->id ?>"><?= $item->name ?></a>
            <?php endforeach ?>
        </p>
    <?php endif ?>

    
    <?php if ($items): ?>
        <?php foreach ($items as $item): ?>
            <div class = "item span-4 round <?= $item->fb_coin_price ? ' item-for-facebook-coin' : '' ?>">
                <strong><?= strtoupper($item->type_name) ?> <?= $item->name ?></strong>
                <p>
                <?php if ($item->shop_item_type_id == 2): ?>
                    <?= $item->speed ?> unit/sec
                <?php else: ?>
                    &nbsp;
                <?php endif ?>
                </p>
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
                    <!-- <a href="<?= base_url() ?>shopmanager/add_item_to/<?= $item->id ?>" rel = "dialog" title = "Add item to <?= $item->name ?>">add item</a>
                    <a href="<?= base_url() ?>shopmanager/items_of/<?= $item->id ?>" rel = "dialog" title = "<?= $item->name ?> items" dialog_id = "shop_<?= $item->id ?>">items</a> -->
                    <a href="<?= base_url() ?>shopmanager/add_item_to/<?= $item->id ?>" rel = "dialog" title = "Add item to <?= $item->name ?>"><strong>add item</strong></a>
                    <a href="<?= base_url() ?>shopmanager/edit/<?= $item->id ?>" rel = "dialog" title = "Edit mine <?= $item->name ?>">edit</a>
                    <a href="<?= base_url() ?>shopmanager/delete/<?= $item->id ?>" class = "delete">delete</a>
                </p>
            </div>
            <div class = "shop-items span-17 round last">
                <!-- <p>
                    <a href="<?= base_url() ?>shopmanager/add_item_to/<?= $item->id ?>" rel = "dialog" title = "Add item to <?= $item->name ?>">add item</a> 
                </p>-->
                <?php if ($shop_items): ?>
                    <?php foreach ($shop_items as $item): ?>
                        <div class = "item span-5 round <?= $item->fb_coin_price ? ' item-for-facebook-coin' : '' ?>">
                            <p>
                                <strong class = "name-and-type">
                                    <?php if ($item->is_free): ?>
                                        <span class = "free">FREE</span>
                                    <?php endif ?>                                    
                                    <?= $item->name ?> (<?= $item->item_type ?>)
                                </strong>
                            </p>
                            
                            <?= form_open(base_url().'shopmanager/update_item/'.$item->id) ?>
                                <p>
                                    Quantity: <input type="text" name = "quantity" id = "quantity" value = "<?= $item->quantity ?>" size = "10"/>
                                </p>
                                <p>
                                    Is free
                                    <input type="checkbox" value = "1" name = "is_free" <?= $item && $item->is_free ? 'checked = "checked"' : '' ?> />
                                    
                                </p>    
                                <a href="javascript:void(0)" class = "update-item">save</a>
                            <?= form_close() ?>
                            
                            <p class = "text-right">
                                <a href="<?= base_url() ?>shopmanager/delete_item/<?= $item->id ?>" class = "delete">delete</a>
                            </p>
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <em>no items</em>
                <?php endif ?>                
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


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
    <legend>Mine items</legend>
    
    <p>
        <a href="<?= base_url() ?>mineitemmanager/edit" rel = "dialog" title = "Add new mine item" dialog_id = "-2">add new mine item</a>
    </p>
    
    <?php if ($items): ?>
        <?php foreach ($items as $item): ?>
            <div class = "item span-4 round">
                <strong><?= $item->name ?></strong>
                
                <p class = "text-right">
                    <a href="<?= base_url() ?>mineitemmanager/edit/<?= $item->id ?>" rel = "dialog" title = "Edit mine item">edit</a>
                    <a href="<?= base_url() ?>mineitemmanager/delete/<?= $item->id ?>" class = "delete">delete</a>
                </p>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    
</fieldset>


<fieldset  class="round">
    <legend>Mines</legend>
    
    <p>
        <a href="<?= base_url() ?>minemanager/edit" rel = "dialog" title = "Add new mine" dialog_id = "-1">add new mine</a>
    </p>
    
    <?php if ($mines): ?>
        <?php foreach ($mines as $item): ?>
            <div class = "item span-5 round">
                <strong><?= $item->name ?></strong>
                
                <p class = "text-right">
                    <a href="<?= base_url() ?>minemanager/add_item_to/<?= $item->id ?>" rel = "dialog" title = "Add item to <?= $item->name ?>">add item</a>
                    <a href="<?= base_url() ?>minemanager/items_of/<?= $item->id ?>" rel = "dialog" title = "<?= $item->name ?> items" dialog_id = "mine_<?= $item->id ?>">items</a>
                    <a href="<?= base_url() ?>minemanager/edit/<?= $item->id ?>" rel = "dialog" title = "Edit mine <?= $item->name ?>">edit</a>
                    <a href="<?= base_url() ?>minemanager/delete/<?= $item->id ?>" class = "delete">delete</a>
                </p>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    
</fieldset>



<?php if ($this->session->userdata('current_mine_item')): ?>
    <script type="text/javascript">
        $(function() {
            App.TriggerDialogOpen('mine_<?= $this->session->userdata("current_mine_item") ?>')
        });
        
    </script>
    <?php $this->session->unset_userdata('current_mine_item');   ?>
<?php endif ?>
<?php if ($mine): ?>
    <h1><?= $mine->mine_name ?></h1>
    
    <p>Select something to mine:</p>
    
    <div class = "span-18 last game-inner-wrapper">
        <?php if ($mine->items): ?>
            <?php foreach ($mine->items as $item): ?>
                
                <?php  
                    $class = '';$isPending = false;
                    if ($this->session->userdata('pending_item') && $this->session->userdata('pending_item') === $item->id) {
                        
                        $label = 'Started...';
                        $isPending = true;
                    } else {
                        $label = 'Select';
                        $class = 'class = "hidden"';
                    }
                ?>
                
                <div class="mine-map span-18 <?= !$isPending ? 'not-pending-item' : 'pending-item' ?>">
                    <h2>
                        <div style = "float:left; position:relative;display:inline-block;">
                            <?= $item->name ?> <?= $item->quantity ?>
                        </div>
                        <img src="<?= base_url() ?>img/miner1.png" alt="" style = "position:relative; top:10px;" <?= $class ?>/>
                        <a href="javascript:void(0)" class = "select-item" data-id = "<?= $item->id ?>">
                            <span class="_start-mining-label">
                                <?= $label ?>
                            </span>
                        </a>
                    </h2>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    
    <p>Select a tool</p>
    
    <div class="span-18 last game-inner-wrapper">
        
    </div>
    
    <div  class="game-button-bg"  style="float:right;">
        <a href="javascript:void(0)" class="change-screen game-button start-mining">Start mining</a>
    </div>    
    
<?php endif ?>
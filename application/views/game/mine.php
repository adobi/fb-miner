<?php if ($mine): ?>
    <h1 id = "selected-mine" data-id = "<?= $mine->id ?>"><?= $mine->mine_name ?></h1>
    <!-- 
    <?= 'pending mine: '.$this->session->userdata('pending_mine') ?><br />
    <?= 'selected mine: '.$mine->id ?><br />
    <?= 'pending mine item: '.$this->session->userdata('pending_mine_item') ?><br />
     -->
    <p>Select something to mine:</p>
    
    <div class = "span-18 last game-inner-wrapper">
        <?php if ($mine->items): ?>
            <?php foreach ($mine->items as $item): ?>
                
                <?php  
                    $class = '';$isPending = false;
                    if (//($this->session->userdata('pending_mine') && $this->session->userdata('pending_mine') === $mine->id) &&
                        ($this->session->userdata('pending_mine_item') && $this->session->userdata('pending_mine_item') === $item->id)) {
                        
                        $label = 'Working...';
                        $isPending = true;
                    } else {
                        $label = 'Select';
                        $class = 'class = "hidden"';
                    }
                ?>
                
                <div class="mine-map span-18 <?= !$isPending ? 'not-pending-item' : 'pending-item' ?>">
                    <h2>
                        <div style = "float:left; position:relative;display:inline-block;">
                            <?= $item->id ?> <?= $item->name ?> <?= $item->quantity ?> 
                        </div>
                        <img src="<?= base_url() ?>img/miner1.png" alt="" style = "position:relative; top:10px;" <?= $class ?>/>
                        <a href="javascript:void(0)" class = "select-mine-item" data-id = "<?= $item->id ?>">
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
        <?php if ($tools): ?>
            <?php foreach ($tools as $tool): ?>
                
                <?php  
                    $class = '';$isPending = false;
                    if (($this->session->userdata('pending_mine') && $this->session->userdata('pending_mine') === $mine->id) &&
                        ($this->session->userdata('pending_tool') && $this->session->userdata('pending_tool') === $tool->id)) {
                        
                        $label = 'Working...';
                        $isPending = true;
                    } else {
                        $label = 'Select';
                        $class = 'class = "hidden"';
                    }
                ?>                
                
                <div class="tool span-18 <?= !$isPending ? 'not-pending-item' : 'pending-item' ?>">
                    <h2>
                        <div style = "float:left; position:relative;display:inline-block;">
                            <?= $tool->id ?> <?= $tool->item_name ?> <?= $tool->speed ?> unit/sec 
                        </div>
                        <img src="<?= base_url() ?>img/daisy.png" alt="" style = "position:relative; top:10px;" <?= $class ?>/>
                        <a href="javascript:void(0)" class = "select-tool" data-id = "<?= $tool->id ?>">
                            <span class="_start-mining-label">
                                <?= $label ?>
                            </span>
                        </a>
                    </h2>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    
    <div  class="game-button-bg"  style="float:right;">
        <a href="javascript:void(0)" class="change-screen game-button start-mining">Start mining</a>
    </div>    
    
<?php endif ?>
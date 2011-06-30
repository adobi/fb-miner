
<?php if ($shopitems): ?>
    <?php foreach ($shopitems as $type => $items): ?>
        <h1><?= strtoupper($type) ?></h1>
        
        <div class="span-19">
            <?php if ($items): ?>
                <?php foreach ($items as $item): ?>
                        <div class = "span-6 shop-item round"  style="background:#ddd; margin:0 10px 10px 0;">
                        <h3 style="margin-bottom:5px;padding-bottom:5px;"><?= $item->name ?></h3>
                        <p>
                            in stock: <?= $item->quantity ?>
                        </p>
                        <?php if (!$item->is_free): ?>
                            <p>
                                price: <?= $item->price ? $item->price.'$' : $item->fb_coin_price.' coin' ?>
                            </p>
                        <?php else: ?>
                            <p>
                                <span class="free">it's free</span>
                            </p>
                        <?php endif ?>
                        <p>
                            <a href="#">buy one</a>
                        </p>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                there are no items in stock
            <?php endif ?>
                
        </div>
    <?php endforeach ?>
<?php endif ?>


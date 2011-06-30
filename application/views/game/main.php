<h1>Choose a Map</h1>

<div class="mines span-19 last" style="float:left;border:0px solid red">
    <?php if ($mines): ?>
        <?php foreach ($mines as $mine): ?>
            <div class="span-6 mine <?= $this->session->userdata('pending_mine') === $mine->id ? 'active-mine' : '' ?>"  style="border:0px solid red">
                <h2><?= $mine->name ?></h2>
                <!-- <div class="map-over"></div> -->
                <a href="<?= base_url() ?>game/mine/<?= $mine->id ?>" class = "change-screen mine-menu-item"></a>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</div>

<h1>Your stuff</h1>

<div class="span-19 last">
    <?php if ($items): ?>
        <?php foreach ($items as $item): ?>
            <div class = "span-6 stuff-item">
                <h2><?= strtoupper($item->item_type) ?> <?= $item->item_name ?> (<?= $item->quantity ?>) </h2>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</div>


<div class="span-19"  style="margin-bottom:10px;">
    <div class="span-19">
        <div  class="game-button-bg"  style="float:right;">
            <a href="#" id = "play-the-game"  class="game-button">Enter the shop</a>
        </div>
        <!-- 
        <div  class="game-button-bg"  style="float:right;">
            <a href="#" id = "play-the-game"  class="game-button">Play the game</a>
        </div>
         -->
    </div>
</div>

<h1>Choose a Map</h1>

<div class = "mines" class="span-19 last" style="float:left;border:0px solid red">
    <?php if ($mines): ?>
        <?php foreach ($mines as $mine): ?>
            <div class="span-6 mine"  style="border:0px solid red">
                <h2><?= $mine->name ?></h2>
                <!-- <div class="map-over"></div> -->
                <a href="#" class = "mine-menu-item"></a>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</div>

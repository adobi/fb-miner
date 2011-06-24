<div class = "span-23">
    
    <?php if (validation_errors()): ?>
        
        <div class = "error">
            <?= validation_errors(); ?>
        </div>
        
    <?php endif ?>
    <fieldset class = "round">
        <legend>Bejelentkezés</legend>
        
        <?= form_open('auth/login') ?>
            <p>
                <label for="username">Felhasználónév:</label><br />
                <input type="text" class = "text" name="username" value="" id="username" />
            </p>
            <p>
                <label for="password">Jelszó</label><br />
                <input type="password" class = "text" name="password" value="" id="password" />
            </p>
            <p>
                <label for="remember_me">
                    <input type="checkbox" name="remember_me" value="" id="remember_me"> Emlékezz rám
                </label>
            </p>
            <p>
                <button>Belépés</button>
            </p>
        <?= form_close() ?>
        
    </fieldset>
    
</div>
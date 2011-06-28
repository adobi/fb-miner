<!DOCTYPE html>
<html xml:lang="hu">

	<head>
		
		<title>Miner</title>

		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		
		<link rel="stylesheet" href="<?= base_url() ?>css/screen.css" type="text/css" media="screen"charset="utf-8">
		<link rel="stylesheet" href="<?= base_url() ?>css/print.css" type="text/css" media="print"charset="utf-8">
		<!--[if lt IE 8]><link rel="stylesheet" href="<?= base_url() ?>css/ie.css" type="text/css" media="screen, projection"><![endif]-->
		
        <link rel="stylesheet" href="<?= base_url() ?>css/jquery-ui-1.8.7.custom.css" type="text/css" media="screen"charset="utf-8">
        <link rel="stylesheet" href="<?= base_url() ?>css/page.css" type="text/css" media="screen"charset="utf-8">
        <link rel="stylesheet" href="<?= base_url() ?>css/iphone-style-checkboxes.css" type="text/css" media="screen" charset="utf-8">
        <link rel="stylesheet" href="<?= base_url() ?>css/colorbox.css" type="text/css" media="screen" charset="utf-8">
        <?php if (!$this->session->userdata('current_user_id') && $this->uri->segment(1) !== 'auth'): ?>
            <link rel="stylesheet" href="<?= base_url() ?>css/game.css?<?= time() ?>" type="text/css" media="screen"charset="utf-8">
        <?php endif ?>
        <!--
		<script type="text/javascript" charset="utf-8" src = "http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
        <script type="text/javascript" charset="utf-8" src = "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.js"></script>
        -->
		<script type="text/javascript" charset="utf-8" src = "<?= base_url() ?>js/jquery.min.js"></script>
        <script type="text/javascript" charset="utf-8" src = "<?= base_url() ?>js/jquery-ui.min.js"></script>
        <script type="text/javascript" charset="utf-8" src = "<?= base_url() ?>js/jquery.cookie.js"></script>
        <script type="text/javascript" charset="utf-8" src = "<?= base_url() ?>js/iphone-style-checkboxes.js"></script>
        <script type="text/javascript" charset="utf-8" src = "<?= base_url() ?>js/colorbox.js"></script>
        
        <?php if ($this->session->userdata('current_user_id') || $this->uri->segment(1) === 'auth'): ?>
            <script type="text/javascript" charset="utf-8" src = "<?= base_url() ?>js/admin.js"></script>
        <?php endif ?>

        <?php if (!$this->session->userdata('current_user_id') && $this->uri->segment(1) !== 'auth'): ?>
            <script type="text/javascript" charset="utf-8" src = "<?= base_url() ?>js/game.js?<?= time() ?>"></script>
        <?php endif ?>

        <script type="text/javascript">
            var App = App || {};
            App.URL = '<?= base_url() ?>';
        </script>
        <script type="text/javascript" charset="utf-8" src = "<?= base_url() ?>js/app.js"></script>
        
	</head>
	
	<body>
	    
		<div id="container" class = "container" <?= $this->session->userdata('current_user_id') || $this->uri->segment(1) === 'auth' ? '' : ' style = "width:760px"' ?>>
			<?php if ($this->session->userdata('current_user_id')) : ?>
        		<div id = "header" class = "span-24 _ui-widget-header ui-corner-all">
        		    <div class = "prepend-2 span-20 append-2">
            			<ul id = "header-menu" class = "span-20">
            			    <!--<li>
            			        <a href="<?= base_url(); ?>welcome">kezdőlap</a>
            			    </li>-->
            			    <li>
            			        <a href="<?= base_url(); ?>shopmanager">shop</a>
            			    </li>
            			    <li>
            			        <a href="<?= base_url(); ?>minemanager">mines</a>
            			    </li>
            			    <li>
            			        <a href="<?= base_url(); ?>usermanager">users</a>
            			    </li>

        			        <li>
        			            <a href="<?= base_url(); ?>auth/logout">logout <span style="font-family:tahoma; font-size:0.8em;">&raquo;</span></a>
        			        </li>			        
            			</ul>
        		    </div>
        		</div> <!-- header -->
        		
			<?php endif; ?>
			<div id="content" class = "span-24 last <?= $this->session->userdata('current_user_id') || $this->uri->segment(1) === 'auth' ? '' : 'game-canvas' ?>">
			    
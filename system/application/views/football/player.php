<html>
<head>
<title><?=$player->name?></title>
<link type="text/css" rel="stylesheet" media="screen" href="<?=base_url()?>/css/style.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<?=js_include("prototype")?>
<?=js_include("effects")?>
<?=js_include("dragdrop")?>
<?=js_include("controls")?>
</head>
<body>

	<h1><?=$player->name?></h1>
		<?php
			if($error != ''){
				echo "<p class='error'>";
					echo $error;
				echo "</p>";
			}else if($notice != ''){
				echo "<p class='notice'>";
					echo $notice;
				echo "</p>";
			}
		?>
		<p><?=$player->name?></p>
		<p><?=$player->body?></p>
		<p><img src="<?=$player->photo?>"></p>
		<p><img src="<?=$player->jersey?>"></p>

</body>
</html>

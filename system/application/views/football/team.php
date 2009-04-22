<html>
<head>
<title>Show team</title>
<link type="text/css" rel="stylesheet" media="screen" href="<?=base_url()?>/css/style.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<?=js_include("prototype")?>
<?=js_include("effects")?>
<?=js_include("dragdrop")?>
<?=js_include("controls")?>
</head>
<body>

	<h1>Show Team!</h1>
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
		<p><?=$team->name?></p>
		<p><?=$team->body?></p>
		<p><?=$team->name?></p>

</body>
</html>

<html>
<head>
<title>New Player</title>
<link type="text/css" rel="stylesheet" media="screen" href="<?=base_url()?>/css/style.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<?=js_include("prototype")?>
<?=js_include("effects")?>
<?=js_include("dragdrop")?>
<?=js_include("controls")?>
</head>
<body>
<h1>New Football Player!</h1>
	<form action="<?=site_url('/football/create_player')?>" method="post" enctype="multipart/form-data" >
		<p>
			<input type='text' name='name'> Нэр
		</p>
		<p>
			<?=country_select()?>
			 Улс 
			<?=team_select()?> Клуб
		</p>
		<p>
			<input type='file' name='photo'> Зураг
		</p>
		<p>
			<input type='file' name='jersey'> Өмсгөл
		</p>
		<p>
			<h3>Мэдээлэл</h3>
			<textarea name='body' rows='25' cols='80'></textarea>
		</p>
		<p>
			<input type='submit' name='btn' value='Үүсгэх'>
		</p>
	</form>
</body>
</html>


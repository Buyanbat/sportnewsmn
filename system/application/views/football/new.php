<html>
<head>
<title>New Football Team</title>
<link type="text/css" rel="stylesheet" media="screen" href="<?=base_url()?>/css/style.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<?=js_include("prototype")?>
<?=js_include("effects")?>
<?=js_include("dragdrop")?>
<?=js_include("controls")?>
</head>
<body>
<h1>New Football Team!</h1>
	<form action="<?=site_url('/football/create')?>" method="post" enctype="multipart/form-data" >
		<p>
			<input type='text' name='name'> Нэр
		</p>
		<p>
			<?=country_select()?>
			 Улс
			<?=league_select()?> Лиг
		</p>
		<p>
			<h3>Мэдээлэл</h3>
			<?=$body?>
		</p>
		<p>
			<input type='file' name='logo'> Лого
		</p>
		<p>
			<input type='submit' name='btn' value='Үүсгэх'>
		</p>
	</form>
</body>
</html>


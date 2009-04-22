<html>
<head>
<title>New Forum</title>
<link type="text/css" rel="stylesheet" media="screen" href="<?=base_url()?>/css/style.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<?=js_include("prototype")?>
<?=js_include("effects")?>
<?=js_include("dragdrop")?>
<?=js_include("controls")?>
</head>
<body>
<h1>New Forum thread!</h1>
	<form action="<?=site_url('/forum/create_thread')?>" method="post" >
		<p>
			<input type='text' name='question'> Сэдвийн нэр
		</p>
		<p>
			<h2> Тайлбар </h2>
			<?=$editor?>
		</p>
		<p>
			<input type='submit' name='btn' value='Үүсгэх'>
		</p>
	</form>
</body>
</html>



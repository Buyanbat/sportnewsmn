<html>
<head>
<title>News</title>
<link type="text/css" rel="stylesheet" media="screen" href="<?=base_url()?>/css/style.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<?=js_include("prototype")?>
<?=js_include("effects")?>
<?=js_include("dragdrop")?>
<?=js_include("controls")?>
<?=js_include("news")?>
<?=css_include("style")?>
</head>
<body>
	<?include(APPPATH."/views/header.php");?>
<div id='body'>
	<div id='left'>
		<div class='leftBox'>
			<div class='leftBox_header'>
				<h2> Хэрэглэгчид</h2>
			</div>
			<div class='leftBox_body'>
				<?php
					$users = get_all_users();
					foreach ($users->result() as $user):
				 ?>
				 <p><?=$user->login?></p>
					<?endforeach;?>
			</div>
			<div class='leftBox_footer'>
			</div>
		</div>
	</div>
	<div id='right'>
		<div class='rightBox'>
			<div class='rightBox_header'>
				<h2>Мэдээ Засах</h2>
			</div>
			<div class='rightBox_body'><br/>
				<form method="post" enctype="multipart/form-data" action="<?=site_url('/news/create')?>" style="font-size: 13px">
					<div style="margin: 10px; width: 600px">
						* Гарчиг
						<input style="padding: 2px; width: 600px; border: 2px solid #3fa1d4;" type='text' name='title'/> 
					</div>
					<div style="margin: 10px;">
						* Богино тайлбар
						<input style="padding: 2px; width:600px; height: 80px; border: 2px solid #3fa1d4;" type='text' name='desc' />
					</div>
					<div id="addCat" style="margin: 10px;">
						<input type='hidden' id="catNum" name="catNum" value="1"/>
						* Мэдээний төрөл
						<a href='javascript:void(0)' onclick="News.addCat()">+</a>
						<a href='javascript:void(0)' onclick="News.rmCat()">-</a>
						<select id='cat_1' name='cat_1'>
						</select>
					</div>
					<div style="margin: 10px;">
						* Нүүрний мэдээ
						<select name='face' onchange="News.inface();" id='face'>
							<option value="0">Үгүй</option>
							<option value="1">Тийм</option>
						</select>
					</div>
					<div id='addImg' style="margin: 10px;">
						<input type='hidden' id="imgNum" name="imgNum" value="1"/>
						* Зураг
						<a href='javascript:void(0)' onclick="News.addImg()">+</a>	
						<a href='javascript:void(0)' onclick="News.rmImg()">-</a>	
						<input type='file' name='img_1' id='img_1' />
					</div>
					<div style="margin-left: 10px">* Мэдээ</div>
					<div style="margin: 10px; border: 2px solid #3fa1d4; ">
						
					</div>
					<div style="margin: 10px;">
						<input style="margin-right: 20px" type='submit' name='btn' value='Хадгалах' />
						<select name='status'>
							<option value='0'>Түр хадгал</option>
							<option value='1'>Нийтэл</option>
						</select>
					</div>
				</form>
					<br/>
			</div>
		
			<div class='rightBox_footer'>
			</div>
		</div>
	</div>
</div>
</body>
</html>



<html>
<head>
<title>User List</title>
<link type="text/css" rel="stylesheet" media="screen" href="<?=base_url()?>/css/style.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<?=js_include("prototype")?>
<?=js_include("effects")?>
<?=js_include("dragdrop")?>
<?=js_include("controls")?>
</head>
<body>
		<?include(APPPATH."/views/header.php");?>
	<h1>Users List!</h1>
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
		<table cellspacing="0">
			<tr>
				<td>Нэр</td>
				<td>И-мэйл</td>
				<td>Нэгдсэн огноо</td>
				<td>Сүүлийн хандалт</td>
			</tr>
			<?foreach($users->result() as $user){?>
				<tr>
					<td><?=$user->login?></td>
					<td><?=$user->email?></td>
					<td><?=$user->register_date?></td>
					<td><?=$user->last_activity?></td>
				</tr>
			<?}?>
		</table>
	<?=link_to_remote_tag("Ajax",array('url'=>site_url('/user/login'),'update'=> array('success'=>'divBox')))?>
	<div id="divBox"></div>

</body>
</html>

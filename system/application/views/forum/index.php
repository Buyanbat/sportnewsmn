<html>
<head>
<title>Forum Threads</title>
<link type="text/css" rel="stylesheet" media="screen" href="<?=base_url()?>/css/style.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<?=js_include("prototype")?>
<?=js_include("effects")?>
<?=js_include("dragdrop")?>
<?=js_include("controls")?>
<?=css_include("style")?>
</head>
<body>
	<?include(APPPATH."/views/header.php");?>
<div id='body'>
		<div class='bigBox'>
			<div class='bigBox_header'>
				<h2>Forum Threads!</h2>
			</div>
			<div class='bigBox_body'>
				<br/>
		<?foreach($forums->result() as $forum) :?>
			<div class='one_forum'>
				<div class='one_forum_header'>
				</div>
				<div class='one_forum_body'>
				<p class='forum_title'><a href="<?=site_url('/forum/thread/').'/'.$forum->id?>"><?=$forum->question?></a></p>
				<span class='forum_det'> Үүсгэсэн огноо: <?=substr($forum->created_at,0,16)?></span>
				<span class='forum_det'> Үүсгэсэн гишүүн: <a href="<?=site_url('/user/show/').'/'.$forum->userid?>"><?=$forum->login?></a></span>
				<span class='forum_det'>Хариулт: <?=$forum->num?></span>
				</div>
				<div class='one_forum_footer'>
				</div>
			</div>
			<?endforeach;?>
					<br/>
				<?=$links?>
			</div>
			
			<div class='bigBox_footer'></div>
		</div>
</div>
</body>
</html>



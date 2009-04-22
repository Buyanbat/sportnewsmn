<html>
<head>
<title>Forum Thread</title>
<link type="text/css" rel="stylesheet" media="screen" href="<?=base_url()?>/css/style.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<?=js_include("prototype")?>
<?=js_include("effects")?>
<?=js_include("dragdrop")?>
<?=js_include("controls")?>
<?=js_include("forum")?>
</head>
<body onload = "Cursor.init();">
<?include(APPPATH."/views/header.php");?>
<div id='body'>
	<div class='bigBox'>
		<div class='bigBox_header'>
			<h2><?=$thread->question?></h2>
			</div>
		<div class='bigBox_body'>
	<p>
		<?=$thread->description?>
		<?foreach($replies->result() as $reply):?>
			<? $user_url = site_url("/user/show/$reply->uid");?>
			<div class='forum_child'>
				<div class='forum_child_header'>
					<span style="line-height: 25px;">
						<a href="<?=$user_url?>" onmouseover="User.Show(<?=$reply->uid?>)" onmouseout="User.Hide()">
							<?=$reply->login?></a> бичсэн нь
					</span> 
					<span style="margin-left: 20px;">
						<?=$reply->created_at?>
					</span>
				</div>
				<div class='forum_child_body'>
					<br/>
					<div class='body'>
						<?=$reply->body?>
					</div>
					<div class='replies'>
						<?=replies_replies($reply->id)?>
					</div>
					<div class='footer'>
						<ul class='forum_menu'>
							<li class='rup' id="rup_<?=$reply->id?>">
							<a class='upscore' href='javascript:void(0)' title = "Сайн үнэлгээ өгөх" onclick="Forum.Up(<?=$reply->id?>)">
							<?=$reply->up?></a>
						</li>
						<li class="rdown" id="rdown_<?=$reply->id?>">
							<a class='downscore'href='javascript:void(0)' title = "Муу үнэлгээ өгөх" onclick="Forum.Down(<?=$reply->id?>)">
							<?=$reply->down?></a>
						</li>
						<li class="rreply" id="rreply_<?=$reply->id?>">
							<a class='reply' title="Хариу бичих" href='javascript:void(0)' onclick="Forum.ReplyRequest(<?=$reply->id?>)"></a>
						</li>
						</ul>
					</div>
				</div>
				<div class='forum_child_footer'>
				</div>
			</div>
		<?endforeach;?>
		<p><?=$links?></p>
	</p>
		<p class='reply'><a href='javascript:void(0);' onclick="Forum.ReplyRequest(0);">Хариулах</a></p>
		</div>
		<div class='bigBox_footer'>
		</div>
		<div id='replyBox' class='replyBox'>
			<div class='replyBox_header'>
			</div>
			<div class='replyBox_body'>
				<form action="<?=site_url('/forum/reply')?>" method='post' >
					<input type='hidden' id='fid' name='fid'  value="<?=$thread->id?>">
					<input type='hidden' id = 'rid' name='rid'  value="0">
					<?=$editor?>
					<input type='submit' value='Илгээх' name='btn'>
					<input type='button' value='Болих' onclick='Forum.Close();'>
				</form>
			</div>
			<div class='replyBox_footer'>
			</div>
		</div>
	</div>
</div>
</body>
</html>



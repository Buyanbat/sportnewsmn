<html>
<head>
<title>News</title>
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
				<h2>News</h2>
			</div>
			<div class='rightBox_body'><br/>
				<div id="news_list" style="font-size: 13px; margin: 2px 15px;">
					<table cellspacing="0" border="0" cellpadding="3">
					<?foreach($news->result() as $post):?>
						<tr style="padding: 2px; border-bottom: 1px dashed #ccc; width: 600px;">
							<td style="font-size: 12px;width: 550px; border-bottom: 1px dashed #ccc">
							<span style="font-size: 11px;"><?=substr($post->created_at,0,16);?></span>
							<?=anchor_to_news($post->id,$post->title,"color: #3c3c3c;font-size: 12px;")?></td>
							<td><?=anchor_to_read_news($post->id)?></td>
							<?if($current_user != NULL && $current_user->roll >= 2){?>
								<td><?=anchor_to_edit_news($post->id)?></td>
								<td><?=anchor_to_delete_news($post->id)?></td>
							<?}?>
						</tr>
					<?endforeach;?>
				</table>
				</div><br/>
			</div>
			<div class='rightBox_footer'>
			</div>
		</div>
	</div>
</div>
</body>
</html>



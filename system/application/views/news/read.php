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
				<h2>Мэдээ #<?=$news->id?></h2>
			</div>
			<div class='rightBox_body'><br/>
				<div style="margin-left: 10px;">
					<h2 style="color: #0f0f0f; font-size: 21px; font-weight:normal;"><?=$news->title?></h2>
					<p style="margin: 5px; color: 333332; font-size: 14px; text-align:justify; width:97%"><?=$news->description?></p>
						<div style="width: 94%; margin: 10px; padding:4px; font-size: 12px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; height: 25px;">
							<span style="padding: 5px; line-height: 24px; height:25px; padding-left: 27px;background: url(<?=base_url()?>/css/images/author.gif) no-repeat" title="Бичсэн"> 
								<?=anchor_to_user($news->uid,$news->login)?>
							</span>
							<span style="padding: 5px; line-height: 24px; height:25px; padding-left: 27px;background: url(<?=base_url()?>/css/images/date.png) no-repeat" title="Бичсэн огноо"> 
								<?=$news->created_at?>
							</span>
							<span style="padding: 5px; line-height: 24px; height:25px; padding-left: 27px;background: url(<?=base_url()?>/css/images/replied.png) no-repeat" title="Сэтгэгдлийн тоо"> 
								<?=$comments->num_rows()?>
							</span>
							<span style="padding: 5px;line-height: 24px; height:25px; padding-left: 27px;background: url(<?=base_url()?>/css/images/readed.gif) no-repeat" title="Уншсан тоо"> 
								<?=$news->viewed?>
							</span>
						</div>
					<div style="font-size:13px; min-height: 350px; text-align: justify; width:97%; ">
						<div style="float: left;width: 350px; height: 320px;padding: 3px;margin: 5px; border: 1px solid #ccc;" >
							<input type='hidden' id="MaxImg" value="<?=$news->pnum?>">
							<div id="pic_container" style="width: 350px; height: 300px; overflow:hidden " >
								<div id="pic_inner">
									<?foreach($photos->result() as $img):?>
										<img src="<?=$img->path?>" width="350px" height="300px" >
									<?endforeach;?>
								</div>
							</div>
							<div style="margin: 0; margin-left: 150px">
								<a class='pic_left' href="javascript:void(0);" onclick="News.prevImg()"> << </a>
								<a class='pic_right' href="javascript:void(0);" onclick="News.nextImg()"> >> </a>
							</div>
						</div>
						<?=$news->body?>
					</div>
				</div>
			<div style="width: 94%; margin: 10px; padding:4px; font-size: 12px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; height: 25px;">
							<span style="padding: 5px; line-height: 24px; height:25px; padding-left: 27px;background: url(<?=base_url()?>/css/images/author.gif) no-repeat" title="Бичсэн"> 
								<?=anchor_to_user($news->uid,$news->login)?>
							</span>
							<span style="padding: 5px; line-height: 24px; height:25px; padding-left: 27px;background: url(<?=base_url()?>/css/images/date.png) no-repeat" title="Бичсэн огноо"> 
								<?=$news->created_at?>
							</span>
							<span style="padding: 5px; line-height: 24px; height:25px; padding-left: 27px;background: url(<?=base_url()?>/css/images/replied.png) no-repeat" title="Сэтгэгдлийн тоо"> 
								<?=$comments->num_rows()?>
							</span>
							<span style="padding: 5px;line-height: 24px; height:25px; padding-left: 27px;background: url(<?=base_url()?>/css/images/readed.gif) no-repeat" title="Уншсан тоо"> 
								<?=$news->viewed?>
							</span>
						</div>
			<br/>
				<h2 style="margin: 0 20px; color: #0f0f0f; font-size: 24px; font-weight:normal;">Сэтгэгдэл</h2>
				<div style="margin:0 20px; width:590px;padding:10px; border-top: 1px solid #ccc;" >
					<?if($current_user != NULL){?>
					<div class='comment_container' style="height: 230px; margin-bottom: 5px;">
						<form method="post" action="<?=site_url('/news/addcomment')?>">
							<input type="hidden" name="news_id" value="<?=$news->id?>" />
							<?=$fck?>
							<input type="submit" name="btn" value="Сэтгэгдэл Үлдээх"/>
						</form>
					</div>
					<?}#endif?>
					<div class='comment_container'>
						<div style="overflow: auto; height: 400px;">
						<div id="comment_inner">
						<?foreach ($comments->result() as $comment):?>
							<div class="one_comment">
								<p style="font-size: 11px; margin: 5px 0px;">
								<?=anchor_to_user($comment->uid,$comment->login)?>
								<?=$comment->created_at?></p>
								<?=$comment->data?>
							</div>
						<?endforeach;?>
						</div>
						</div>
					</div>
				</div><br/>
			</div>
			<div class='rightBox_footer'>
			</div>
		</div>
	</div>
</div>
</body>
</html>



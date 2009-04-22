<html>
<head>
<title>New Forum</title>
<link type="text/css" rel="stylesheet" media="screen" href="<?=base_url()?>/css/style.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<?=js_include("prototype")?>
<?=js_include("effects")?>
<?=js_include("dragdrop")?>
<?=js_include("controls")?>
<?=js_include("home")?>
<?=css_include("style")?>
</head>
<body onload="Face.Init();">
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
					<br/><br/><br/><br/><br/><br/><br/>
				</div>
				<div class='leftBox_footer'>
				</div>
			</div>
		</div>
		<div id='right'	>
			<div class='rightBox'>
				<div class='rightBox_header'>
					<h2>Right Box</h2>
				</div>
				<div class='rightBox_body'><br/>
					<div id="face_container" style="margin: 0px 5px;width: 660px; height:380px; overflow: hidden">
						<div id="face_inner" style="width: 400px; height: 360px; margin: 0;">
						</div>
						<div style="display: none">
							<?$i=0;?>
							<?foreach ($news->result() as $post):?>
								<?$i++;?>
								<div id="inner_<?=$i?>">
									<img src="<?=$post->path?>" width="360px" height="260px;">
									<p style="margin: 4px; font-weight: bold; width: 360px;"><?=$post->title?></p>
									<p style="margin: 4px; width: 360px; font-size: 12px;"><?=$post->description?></p>
								</div>
							<?endforeach;?>
						</div>
						<div style="position: relative; top: -360px; left: 370px;">
							<?$i=0;?>
							<?foreach ($news->result() as $post):?>
								<?$i++;?>
								<div id="face_ctl_<?=$i?>" class="face_ctl"onmouseover = "Face.Touch(<?=$i?>)">
									<p><b><?=$post->title?></b></p>
									<p><?=substr($post->description,0,130)?>...</p>
								</div>
							<?endforeach;?>
						</div>
					</div>
					<div id="tabs">
						<ul>
							<li style="margin-left: 1px" id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,3)">Хөлбөмбөг</a></li>
							<li id="tabHeader2"><a href="javascript:void(0)" onClick="toggleTab(2,3)" >Сагсан бөмбөг</a></li>
							<li id="tabHeader3"><a href="javascript:void(0)" onclick="toggleTab(3,3)">Бусад</a></li>
						</ul>
						<div id="tabscontent">
							<div id="tabContent1" class="tabContent" style="display: yes">
								<table>
									<th>Огноо</th>
									<th>Мэдээ</th>
									<th>Үзсэн</th>
									<th>Сэтгэгдэл</th>
								<?foreach ($fnews->result() as $post):?>
									<tr>
										<td>
											<span style="color:green;font-size:10px;">
												<?=substr($post->created_at,5,11)?>
											</span>
										</td>
										<td>
											<span>
												<?=$post->title?>
											</span>
										</td>
										<td>
											<?=$post->viewed?>
										</td>
										<td>
											<?=$post->cnum?>
										</td>
									</tr>
								<?endforeach;?>
								</table>
							</div>
							<div id="tabContent2" class="tabContent" style="display: none">
								<table>
									<th>Огноо</th>
									<th>Мэдээ</th>
									<th>Үзсэн</th>
									<th>Сэтгэгдэл</th>
								<?foreach ($bnews->result() as $post):?>
									<tr>
										<td>
											<span style="color:green;font-size:10px;">
												<?=substr($post->created_at,5,11)?>
											</span>
										</td>
										<td>
											<span>
												<?=$post->title?>
											</span>
										</td>
										<td>
											<?=$post->viewed?>
										</td>
										<td>
											<?=$post->cnum?>
										</td>
									</tr>
								<?endforeach;?>
								</table>
							</div>
							<div id="tabContent3" class="tabContent" style="display: none">
								<table>
									<th>Огноо</th>
									<th>Мэдээ</th>
									<th>Үзсэн</th>
									<th>Сэтгэгдэл</th>
								<?foreach ($onews->result() as $post):?>
									<tr>
										<td>
											<span style="color:green;font-size:10px;">
												<?=substr($post->created_at,5,11)?>
											</span>
										</td>
										<td>
											<span>
												<?=$post->title?>
											</span>
										</td>
										<td>
											<?=$post->viewed?>
										</td>
										<td>
											<?=$post->cnum?>
										</td>
									</tr>
								<?endforeach;?>
								</table>
							</div>
						</div>
					</div>
				<br/></div>
				<div class='rightBox_footer'>
				</div>
			</div>
		</div>
	</div>
</body>
</html>



<script type="text/javascript">

function site_url(){
	var site_url = "<?=site_url()?>";
	return site_url;
}
function base_url(){
	var base_url = "<?=base_url()?>";
	return base_url();
}

var Cursor = {
	X : 0,
	Y : 0,
	init : function() {
		if (window.Event) {
			document.captureEvents(Event.MOUSEMOVE);
		}
		document.onmousemove = this.getCursorXY;
	},
	getCursorXY : function (e) {
		this.X = (window.Event) ? e.pageX : event.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
		this.Y = (window.Event) ? e.pageY : event.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
		document.getElementById('cursor_x').value = this.X;
		document.getElementById('cursor_y').value = this.Y;
	}
	
};



</script>
<div id='header'>
	<ul>
		<li> <a href="<?=site_url()?>">Нүүр</a></li>
		<li> <a href="<?=site_url('/user')?>">Хэрэглэгч</a></li>
		<li> <a href="<?=site_url('/forum')?>">Хэлэлцүүлэг</a></li>
		<li> <a href="<?=site_url('/news')?>">Мэдээ</a></li>
		
	</ul>
	<input type='hidden' id='cursor_x' value='0' />
	<input type='hidden' id='cursor_y' value='0' />
	<div id='banner'>
	</div>
	<div id='user_stats'>
		<div id='user_stats_right'>
			<?=user_stats()?>
		</div>
		<div id='user_stats_left'>
			<?
				$current_url = current_url();
				$log_url = site_url('/user/login');
				if($current_user != NULL){
					echo "Logged in $current_user->login";
				}else {
				echo "<form method='post' action='$log_url'>";
					echo "<input type='hidden' name='back' value='$current_url' />";
					echo "<input type='text' name='login'><br/>";
					echo "<input type='password' name='password'><br/>";
					echo "<input type='submit' name='btn' value='Log in'>";
				echo "</form>";
				}
			?>
		</div>
	</div>
</div>
<?php
	if($error != ''){
		echo "<p class='error'>$error</p>";
	}else if($notice != ''){
		echo "<p class='notice'>$notice</p>";
	}

?>

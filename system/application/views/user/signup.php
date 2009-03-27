<html>
<head>
<title>Register</title>
<link type="text/css" rel="stylesheet" media="screen" href="<?=base_url()?>/css/style.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
</head>
<body>

	<h1>Register!</h1>
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
		<form action="" method="post">
		<p>
			<input type='text' name='login'> Нэр
		</p>
		<p>
			<input type='text' name='email'> Email
		</p>
		<p>
			<input type='password' name='password'> Нууц үг
		</p>
		<p>
			<input type='submit' name='btn' value='Register'>
		</p>
	</form>
</body>
</html>

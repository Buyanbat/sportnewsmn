<html>
<head>
<title>User List</title>
<link type="text/css" rel="stylesheet" media="screen" href="<?=base_url()?>/css/style.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
</head>
<body>

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

</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="frm">
		<form action="process.php" method="POST">
			<?php
				if (@$_GET['Empty'] == true) {
			?> 
				<div class="alert_box">
					<?php
						echo @$_GET['Empty'];
					?>
				</div>
			<?php
				}
			?>

			<?php
				if (@$_GET['Invalid'] == true) {
			?> 
				<div class="alert_box">
					<?php
						echo @$_GET['Invalid'];
					?>
				</div>
			<?php
				}
			?>
			<p>
				<Label> Username: </Label>
				<input type="text" id="user" name="username"/>
			</p>
			<p>
				<Label> Password: </Label>
				<input type="password" id="pass" name="password" />
				<input type="submit" name="Login" id="btn" value="Login" />
			</p>
		</form>
	</div>
</body>
</html>
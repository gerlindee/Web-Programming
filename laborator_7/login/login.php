<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="frm">
		<form action="connection.php" method="POST">
			<p>
				<Label> Username: </Label>
				<input type="text" id="user" name="username"/>
			</p>
			<p>
				<Label> Password: </Label>
				<input type="password" id="pass" name="password" />
				<input type="submit" id="btn" value="Login" />
			</p>
		</form>
	</div>
</body>
</html>

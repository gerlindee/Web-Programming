<?php
	session_start();

	if (isset($_SESSION['User'])) {

		echo "Welcome ".$_SESSION['User'].'<br/>';
		echo '<a href="logout.php?Logout">Logout</a>';
	} else {

		header("location:login.php");
	}
?>

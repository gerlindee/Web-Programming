<?php
	session_start();
	if (isset($_GET['Logout']))	{

		session_destroy();
		header("location:login.php");
	} 
?>
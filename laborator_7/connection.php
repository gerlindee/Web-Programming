<?php
	$connection = mysqli_connect('localhost', 'root', '', 'laborator_7');
	if (!$connection) {
		die('Please check your connection!'.mysqli_error($connection));
	}
?>

<?php
	
	require_once('connection.php');

	if (isset($_POST['Add'])) {

		$url = $_POST['url'];
		$description = $_POST['description'];
		$category = $_POST['category'];

		$query = "INSERT INTO links (address, description, category) VALUES ('$url','$description','$category')";

		$result = mysqli_query($connection, $query);

		header("location:welcome.php");
	}

	if (isset($_GET['delete'])) {
		$id = $_GET['delete'];

		$query = "DELETE FROM links WHERE id = '$id'";

		$result = mysqli_query($connection, $query);

		header("location:welcome.php");
	}
?>

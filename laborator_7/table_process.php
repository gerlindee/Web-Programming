<?php
	// session_start();

	$address = '';
	$description = '';
	$category = '';
	$id = 0;
	$update = false;

	$connection = mysqli_connect('localhost', 'root', '', 'laborator_7');

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

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$result = mysqli_query($connection ,"SELECT * FROM links WHERE id = '$id'");
		$rowCount = mysqli_num_rows($result);
		if ($rowCount == 1) {
			$row = $result->fetch_array();
			$address = $row['address'];
			$description = $row['description'];
			$category = $row['category'];
		} else {
			echo "Something's fishy";
		}
	}

	if (isset($_POST['Update'])) {
		$id = $_POST['id'];
		$address = $_POST['url'];
		$description = $_POST['description'];
		$category = $_POST['category'];

		$query = "UPDATE links SET address = '$address', description = '$description', category = '$category' WHERE id = '$id'";

		mysqli_query($connection, $query);
		header("location:welcome.php");
	}
?>

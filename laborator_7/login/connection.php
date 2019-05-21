<?php
	$connect = new mysqli('localhost', 'root', '', 'laborator_7');

	if ($connect -> connect_error) {
		die("Connection failed!");
	} else {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql_query = "SELECT username FROM user WHERE username = '$username'";
		$result = $connect->query($sql_query);
		if ($result->num_rows == 0) {
			echo "Username not in the database!";
		} else {
			$sql_query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
			$result = $connect->query($sql_query);
			if ($result->num_rows == 0) {
				echo "Incorrect password!";
			} else {
				$row = $result->fetch_assoc();
				echo "Welcome user ".$row["username"];	
			}

		}


	}

?>

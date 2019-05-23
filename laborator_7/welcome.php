<?php
	session_start();

	if (isset($_SESSION['User'])) {

		?>

		<!DOCTYPE html>
		<html>
		<head>
			<title>URL Collection</title>
			<link rel="stylesheet" type="text/css" href="style.css">
		</head>

		<body>
			<div class="links">
				<p>
					<?php
						echo "Welcome ".$_SESSION['User'].'<br/>';
					?>
				</p>
				<p>
					<?php
					
					echo '<a href="logout.php?Logout">(Logout)</a>';
				?>
				</p>
			</div>

			<?php
				require_once('connection.php'); 
				$query = "SELECT * FROM links";
				$result = mysqli_query($connection, $query);
			?>

			<div>
				<table class="links_table">
					<thead>
						<tr>
							<th> Address </th>
							<th> Description </th>
							<th> Category </th>
							<th colspan="2">Action</th>
					</thead>

					<?php
						while ($row = $result->fetch_assoc()): ?>
						<tr>
							<td> <?php echo $row['address']; ?> </td>
							<td> <?php echo $row['description']; ?> </td>
							<td> <?php echo $row['category']; ?> </td>
						</tr>
					<?php endwhile; ?>
				</table>
			</div>

			<div class="post_form">
				<form action="table_process.php" method="POST">
					<input type="text" name="url" placeholder="URL">
					<input type="text" name="description" placeholder="Description">
					<input type="text" name="category" placeholder="Category">
					<input type="submit" name="Add" value="Add URL" id="btn">
				</form>
			</div>
		</body>
		</html>

		<?php
		
	} else {

		header("location:login.php");
	}
?>

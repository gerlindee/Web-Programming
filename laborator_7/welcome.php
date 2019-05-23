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
			<form action="table_process.php" method="POST">
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
					require_once('table_process.php');
					$connection = mysqli_connect('localhost', 'root', '', 'laborator_7');
					$query = "SELECT * FROM links";
					$result = mysqli_query($connection, $query);
				?>

				<div>
					<table class="links_table">
						<thead>
							<tr>
								<th style="width: 400px"> Address </th>
								<th style="width: 400px"> Description </th>
								<th> Category </th>
								<th colspan="2">Action</th>
							</tr>
						</thead>

						<?php
							while ($row = $result->fetch_assoc()): ?>
							<tr>
								<td> <?php echo $row['address']; ?> </td>
								<td> <?php echo $row['description']; ?> </td>
								<td> <?php echo $row['category']; ?> </td>
								<td style="display: none"> <input type="text" name="id" style="width: 95%" value='<?php echo $row['id']; ?>'> </td>
								<td> 
									<a href="welcome.php?edit=<?php echo $row['id']; ?>" class = "edit_button"> Edit </a>
									<a href="table_process.php?delete=<?php echo $row['id']; ?>" class="delete_button"> Delete </a>
								</td>
							</tr>
						<?php endwhile; ?>
					</table>
				</div>

				<div class="post_form">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="text" name="url" value="<?php echo $address?>" placeholder="URL">
					<input type="text" name="description" value="<?php echo $description?>" placeholder="Description">
					<input type="text" name="category" value="<?php echo $category?>" placeholder="Category">
					<?php if ($update == true): ?>
						<input type="submit" name="Update" value="Update" id="btn">
					<?php else: ?>
						<input type="submit" name="Add" value="Save" id="btn">
					<?php endif; ?>
				</div>
			</form>
		</body>
		</html>

		<?php
		
	} else {

		header("location:login.php");
	}
?>

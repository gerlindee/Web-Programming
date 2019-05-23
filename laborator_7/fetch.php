<?php

  $conn = mysqli_connect('localhost','root','','laborator_7');
  $request=$_POST['request'];
  if ($request == "all") {
  	$query = "SELECT * FROM links";
  } else {
  	$query="select * from links where category='$request'";
  }
  $result = mysqli_query($conn, $query);
  
  echo '<div>
  			<table class="links_table">
				<thead>	
					<tr>
						<th style="width: 400px"> Address </th>
						<th style="width: 400px"> Description </th>
						<th> Category </th>
						<th colspan="2">Action</th>
					</tr>
				</thead>';

	while ($row = $result->fetch_assoc()) {
		echo '<tr>';
			echo '<td>'.$row['address'].'</td>';
			echo '<td>'.$row['description'].'</td>';
			echo '<td>'.$row['category'].'</td>';
			echo '<td style="display: none"> <input type="text" name="id" style="width: 95%" value='.$row['id'].'</td>';
			echo '<td>';
			   echo '<a href="welcome.php?edit='.$row['id'].'" class = "edit_button"> Edit </a>';
			   echo '<a href="table_process.php?delete='.$row['id'].'" class="delete_button"> Delete </a>';
			echo '</td>';
		echo '</tr>';
	}
				
		echo '</table>';
	echo '</div>';
?>

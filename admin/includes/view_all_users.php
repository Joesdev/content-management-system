<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Role</th>
			<th colspan="2">Change</th>
			<th>Delete</th>
	</thead>

	<tbody>
							
		<?php
		// Collect each row from database
		$query = "SELECT * FROM users ";
		$select_users = mysqli_query($connection, $query);
		while($row = mysqli_fetch_assoc($select_users)){
			$user_id = $row['user_id'];
			$user_name = $row['user_name'];
			$user_password = $row['user_password'];
			$user_firstname = $row['user_firstname'];
			$user_lastname = $row['user_lastname'];
			$user_email = $row['user_email'];
			$user_image = $row['user_image'];
			$user_role = $row['user_role'];

			echo "<tr>";
			echo "<td> $user_id </td>";
			echo "<td> $user_name </td>";
			echo "<td> $user_firstname </td>";

	/*		// Retreive id and category for database
			$query = "SELECT * FROM categories WHERE cat_id = {$post_Category} ";
			$cat_info_query =  mysqli_query($connection, $query);

			while($row = mysqli_fetch_assoc($cat_info_query)){
				$cat_name = $row['cat_title'];
					echo "<td> {$cat_name} </td>";
				
			}
	*/

			echo "<td> $user_lastname </td>";
			echo "<td> $user_email </td>";
			echo "<td> $user_role </td>";
			
			// Relational Database Tables: comments , posts
			/*$query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
			$select_post_id_query = mysqli_query($connection, $query);
			while($row = mysqli_fetch_assoc($select_post_id_query)){
				
				$post_id = $row['post_id'];
				$post_title = $row['post_title'];
				
				echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a> </td>";
			}*/
			
			echo "<td><a href='./users.php?role=Subscriber&this_id={$user_id}'>Subscriber</a></td>";
			echo "<td><a href='./users.php?role=Admin&this_id={$user_id}'>Admin</a></td>";
			echo "<td><a href='./users.php?delete=$user_id'>Delete</a></td>";
			echo "<td><a href='./users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
			echo "</tr>";
		}

		?>
							
	</tbody>
</table>



<?php
		if(isset($_GET['role'])){
		$the_user_role = $_GET['role'];
		$the_user_id = $_GET['this_id'];
		$query = "UPDATE users SET user_role = '$the_user_role' WHERE user_id = $the_user_id ";
		$user_role_query = mysqli_query($connection, $query);
		// Reload Page
		header("Location: users.php");
	}



/*	if(isset($_GET['unapprove'])){
		$the_comment_id = $_GET['unapprove'];
		$query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $the_comment_id ";
		$unapprove_status_Query = mysqli_query($connection, $query);
		// Reload Page
		header("Location: comments.php");
	}*/


	if(isset($_GET['delete'])){
		$the_user_id = $_GET['delete'];
		$query = "DELETE FROM users WHERE user_id = {$the_user_id}";
		$delete_user_Query = mysqli_query($connection, $query);
		// Reload Page
		header("Location: users.php");
	}





?>
				
			
		
		
		
		
		
		
		
		
		
	









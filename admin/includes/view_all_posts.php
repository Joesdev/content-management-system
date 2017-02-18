<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Author</th>
			<th>Title</th>
			<th>Category</th>
			<th>Status</th>
			<th>Image</th>
			<th>Tags</th>
			<th>Comments</th>
			<th>Dates</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>

	<tbody>
							
		<?php
		// Collect each row from database
		$query = "SELECT * FROM posts ";
		$select_Posts = mysqli_query($connection, $query);
		while($row = mysqli_fetch_assoc($select_Posts)){
			$post_Id = $row['post_id'];
			$post_Author = $row['post_author'];
			$post_Title = $row['post_title'];
			$post_Category = $row['post_category_id'];
			$post_Status = $row['post_status'];
			$post_Image = $row['post_image'];
			$post_Tags = $row['post_tags'];
			$post_Comment_Count = $row['post_comment_count'];
			$post_Date = $row['post_date'];

			echo "<tr>";
			echo "<td> $post_Id </td>";
			echo "<td> $post_Author </td>";
			echo "<td> $post_Title </td>";

			// Retreive id and category for database
			$query = "SELECT * FROM categories WHERE cat_id = {$post_Category} ";
			$cat_info_query =  mysqli_query($connection, $query);

			while($row = mysqli_fetch_assoc($cat_info_query)){
				$cat_name = $row['cat_title'];
				echo "<td> $cat_name </td>";
				
			}
 
			echo "<td> $post_Status </td>";
			echo "<td><img width=100 src='../images/$post_Image' > </td>";
			echo "<td> $post_Tags </td>";
			echo "<td> $post_Comment_Count </td>";
			echo "<td> $post_Date </td>";
			echo "<td><a href='posts.php?source=edit_post&p_id={$post_Id}'>Edit</a></td>";
			echo "<td><a href='posts.php?delete={$post_Id}'>Delete</a></td>";
			echo "</tr>";
		}

		?>
							
	</tbody>
</table>
<?php

	if(isset($_GET['delete'])){
		
		$caught_post_id = $_GET['delete'];
		$query = "DELETE FROM posts WHERE post_id = {$caught_post_id}";
		$delete_Query = mysqli_query($connection, $query);
		
		header("Location: posts.php");
	}





?>
				
			
		
		
		
		
		
		
		
		
		
	









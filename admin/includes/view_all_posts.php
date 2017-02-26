<?php 
	if(isset($_POST['checkBoxArray'])){
		foreach($_POST['checkBoxArray'] as $postValueId){
			$bulk_options = $_POST['bulk_options']; 
			switch($bulk_options){
				case 'published':
					$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '$postValueId' ";
					$update_publish_status = mysqli_query($connection,$query);
					confirmQuery($update_publish_status);
					break;
				case 'draft':
					$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '$postValueId' ";
					$update_draft_status = mysqli_query($connection,$query);
					confirmQuery($update_draft_status);
					break;
				case 'delete':
					$query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
					$delete_post = mysqli_query($connection,$query);
					confirmQuery($delete_post);
					break;
			}
		}
	}


?>


<form action="" method='POST'> 
	<table class="table table-bordered table-hover">
		
		<div id="bulkOptionsContainer" class="col-xs-4">
			
			<select class ="form-control" name="bulk_options" id="">
				<option value="">Select Options</option>
				<option value="published">Publish</option>
				<option value="draft">Draft</option>
				<option value="delete">Delete</option>
			</select>
			
		</div>
		<div>
			
			<input type="submit" name="submit" class="btn btn-success" value="Apply">
			<a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
				
		</div>
		
		<thead>
			<tr>
				<th><input type="checkbox" id="selectAllBoxes"></th>
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
				?>
				<td><input class ='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_Id ;?>'></td>
				<?php
				echo "<td> $post_Id </td>";
				echo "<td> $post_Author </td>";
				echo "<td> <a href ='post.php?p_id=$post_Id'> $post_Title </a></td>";

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
</form>
<?php

	if(isset($_GET['delete'])){
		
		$caught_post_id = $_GET['delete'];
		$query = "DELETE FROM posts WHERE post_id = {$caught_post_id}";
		$delete_Query = mysqli_query($connection, $query);
		
		header("Location: posts.php");
	}





?>
				
			
		
		
		
		
		
		
		
		
		
	









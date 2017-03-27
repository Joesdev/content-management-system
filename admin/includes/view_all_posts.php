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
				case 'clone':
					$query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
					$select_post_query = mysqli_query($connection, $query);
					
					while($row = mysqli_fetch_array($select_post_query)){
						
						$post_Title = $row['post_title'];
						$post_Author = $row['post_author'];
						$post_Category_Id = $row['post_category_id'];
						$post_Status =$row['post_status'];

						$post_Image = $row['post_image'];
						//$post_Image_Temp = $_FILES['image']["tmp_name"];

						$post_tags = $row['post_tags'];
						$post_content = $row['post_content'];
						$post_Date = $row['post_date'];
						//$post_comment_count = 4;

						// Move Picture from temporary server space to actual.

						$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image
									, post_content, post_tags, post_status) ";
						$query .= "VALUES({$post_Category_Id}, '{$post_Title}', '{$post_Author}',now()
									, '{$post_Image}', '{$post_content}', '{$post_tags}','{$post_Status}' )" ;

						$create_Post_Query = mysqli_query($connection, $query);

						confirmQuery($create_Post_Query);
						break;
						
					}
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
				<option value="clone">Clone</option>
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
				<th>Views</th>
			</tr>
		</thead>

		<tbody>

			<?php
			// Collect each row from database
			$query = "SELECT * FROM posts ORDER BY post_id DESC ";
			$select_Posts = mysqli_query($connection, $query);
			while($row = mysqli_fetch_assoc($select_Posts)){
				$post_Id = $row['post_id'];
				$post_Author = $row['post_author'];
				$post_User = $row['post_user'];
				$post_Title = $row['post_title'];
				$post_Category = $row['post_category_id'];
				$post_Status = $row['post_status'];
				$post_Image = $row['post_image'];
				$post_Tags = $row['post_tags'];
				$post_Comment_Count = $row['post_comment_count'];
				$post_Date = $row['post_date'];
				$post_view_count = $row['post_view_count'];

				echo "<tr>";
				?>
				<td><input class ='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_Id ;?>'></td>
				<?php
				echo "<td> $post_Id </td>";
				
				
				
				if( isset($post_Author) || !empty($post_Author) ){
					echo "<td> $post_Author </td>";
				} else if( $post_User || !empty($post_User)  ) {
					echo "<td> $post_User </td>";
				}
				
				
				
				
				
				echo "<td> <a href ='../post.php?p_id=$post_Id'> $post_Title </a></td>";
				
				
				
				
				

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
				
				$query = "SELECT * FROM comments WHERE comment_post_id = $post_Id";
				$send_comment_query = mysqli_query($connection, $query);
				$count_comments = mysqli_num_rows($send_comment_query);
				
				
				
				
				echo "<td> <a href='comments.php?source=view_selected_comments&p_id=$post_Id'> $count_comments </a> </td>";
				echo "<td> $post_Date </td>";
				echo "<td><a href='posts.php?source=edit_post&p_id={$post_Id}'>Edit</a></td>";
				echo "<td><a onClick=\"javascript: return confirm('Are You Sure You Want To Delete?'); \"href='posts.php?delete={$post_Id}'>Delete</a></td>";
				echo "<td><a href='posts.php?reset={$post_Id}'>{$post_view_count}</a></td>";
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

		if(isset($_GET['reset'])){
		
		$caught_post_id = $_GET['reset'];
		$query = "UPDATE posts SET post_view_count = 0 WHERE post_id =  {$caught_post_id}";
		$reset_query = mysqli_query($connection, $query);
		
		header("Location: posts.php");
	}




?>
				
			
		
		
		
		
	







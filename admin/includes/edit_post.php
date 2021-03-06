<?php

	if(isset($_GET['p_id'])){
		$the_post_id = $_GET['p_id'];
	}

	// Collect each row from database
	$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
	$select_Posts_By_Id = mysqli_query($connection, $query);
	
	// Ghost Text in input boxes
	while($row = mysqli_fetch_assoc($select_Posts_By_Id)){
		$post_Id = $row['post_id'];
		$post_user = $row['post_user'];
		$post_Title = $row['post_title'];
		$post_Category = $row['post_category_id'];
		$post_Status = $row['post_status'];
		$post_Image = $row['post_image'];
		$post_Tags = $row['post_tags'];
		$post_Content = $row['post_content'];
		$post_Comment_Count = $row['post_comment_count'];
		$post_Date = $row['post_date'];
		
	}
	
	// On Update Button Click
	if(isset($_POST['update_post'])){
		
		// Change values to edited values from forms
		$post_user = $_POST['post_user'];
		$post_Title = $_POST['post_Title']; 
		$post_Category = $_POST['post_category'];
		$post_Status = $_POST['post_status'] ;
		$post_Image = $_FILES['image']['name'];
		$post_Image_Temp = $_FILES['image']['tmp_name'];
		$post_Tags = $_POST['post_tags'];
		$post_Content = $_POST['post_content'];
		
		move_uploaded_file($post_Image_Temp, "../images/$post_Image");
		
		// Image doesn't use post, check for value before proceeding
		if(empty($post_Image)){
			$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
			$select_image = mysqli_query($connection, $query);
			
			while($row2 = mysqli_fetch_array($select_image)){
				$post_Image = $row2['post_image'];
			}
		}
		
		$query = "UPDATE posts SET ";
		$query .= "post_title = '{$post_Title}', ";
		$query .= "post_category_id = '{$post_Category}', ";
		$query .= "post_date = now(), ";
		$query .= "post_user = '{$post_user}', ";
		$query .= "post_status = '{$post_Status}', ";
		$query .= "post_tags = '{$post_Tags}', ";
		$query .= "post_content = '{$post_Content}', ";
		$query .= "post_image = '{$post_Image}' ";
		$query .= "WHERE post_id = '{$the_post_id}'";
		
		$update_post_query = mysqli_query($connection, $query);
		
		confirmQuery($update_post_query);
		
		echo "<p class='bg-success'>Post Updated: <a href='../post.php?p_id=$the_post_id'>View Post</a> or <a href='posts.php'>View More Posts</a></p>";
	}
?>





<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="title">Post Title</label>
		<input value="<?php echo $post_Title; ?>" type="text" class="form-control" name="post_Title">		
		</div>
		
	<div class="form-group">
		<label for="users">Categories</label>
		<select name="post_category" id="" >
			<?php 
				// Retreive a Single Row of Information
				$query = "SELECT * FROM categories WHERE cat_id = $post_Category ";
				$select_cat_id = mysqli_query($connection, $query);
				$row = mysqli_fetch_assoc($select_cat_id);
			
				$cat_id = $row['cat_id'];
				$cat_title = $row['cat_title'];
			
				confirmQuery($select_cat_id);
				// Show Selected Category Option
			?>
				<option value="<?php echo $cat_id; ?> "><?php echo $cat_title?></option>

			<?php 

				// Retreive All Rows
				$query = "SELECT * FROM categories ";
				$select_cat = mysqli_query($connection, $query);
				confirmQuery($select_cat);

				while($row = mysqli_fetch_assoc($select_cat)){
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];

					// Show All Category Options
						echo "<option value='{$cat_id}'>{$cat_title}</option>";
				}

			?>
		</select>	
	</div>
	
		<div class="form-group">
	
		<label for="users">Users</label>
	
		<select name="post_user" id="">
		<?php echo "<option value='{$post_user}'>{$post_user}</option>"; ?>
		<?php 
			
				$query = "SELECT * FROM users ";
				$select_users = mysqli_query($connection, $query);
			
				confirmQuery($select_users);

				while($row = mysqli_fetch_assoc($select_users)){
					$user_id = $row['user_id'];
					$user_name = $row['user_name'];
					
					echo "<option value='{$user_name}'>{$user_name}</option>";
					
				}

			?>	
		</select>	
	</div>
	
	
		
<!--	<div class="form-group">
		<label for="title">Post User</label>
		<input value="<?php //echo $post_user; ?>" type="text" class="form-control" name="post_Author">
	</div>	-->
	
	
	<div class="form-group">
		<label for="status">Status</label>
		<select name="post_status" id="">
			<option value='<?php echo $post_Status;?>'><?php echo $post_Status; ?></option>
				<?php
					if($post_Status == "published"){
						echo "<option value='draft'>draft</option>";
					} else{
						echo "<option value='published'>publish</option>";
					}
				?>
		</select>
	</div>
	

	
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<img width=100 src="../images/<?php echo $post_Image; ?>" alt=""/>
		<input type="file" name="image" class="form-control">
	</div>	
	
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input value="<?php echo $post_Tags; ?>" type="text" class="form-control" name="post_tags">
	</div>	
	
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_Content; ?></textarea>
	</div>	
	
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_post" value="Update">
	</div>	
	
</form>
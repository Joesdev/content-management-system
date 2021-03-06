<?php
	// check button press
	if(isset($_POST['create_post'])){
		$post_Title = $_POST['title'];
		$post_User = $_POST['post_user'];
		$post_Category_Id = $_POST['post_category'];
		$post_Status = $_POST['post_status'];
		
		$post_Image = $_FILES['image']['name'];
		$post_Image_Temp = $_FILES['image']["tmp_name"];
		
		$post_tags = $_POST['post_tags'];
		$post_content = $_POST['post_content'];
		$post_Date = date('d-m-y');
		//$post_comment_count = 4;
		
		// Move Picture from temporary server space to actual.
		
		if(move_uploaded_file($post_Image_Temp , "../images/$post_Image")){
			echo "<h1>Image has been uploaded.</h1>";
		} else {
			echo "File failed to upload.";
		};
		
		$query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image
					, post_content, post_tags, post_status) ";
		$query .= "VALUES({$post_Category_Id}, '{$post_Title}', '{$post_User}',now()
					, '{$post_Image}', '{$post_content}', '{$post_tags}','{$post_Status}' )" ;
		
		$create_Post_Query = mysqli_query($connection, $query);
		
		confirmQuery($create_Post_Query);
		
		// Returns auto generated ID used in the last query
		$thePostId = mysqli_insert_id($connection);
		
		echo "<p class='bg-success'>Post Created!: <a href='../post.php?p_id=$thePostId'>View Post</a> or <a href='posts.php'>View More Posts</a></p>";
		
	}

?>


<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="title">		
		</div>
		
	<div class="form-group">
	
		<label for="category">Category</label>
	
		<select name="post_category" id="">
		<?php 
			
				$query = "SELECT * FROM categories ";
				$select_cat = mysqli_query($connection, $query);
			
				confirmQuery($select_cat);

				while($row = mysqli_fetch_assoc($select_cat)){
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];
					
					echo "<option value='{$cat_id}'>{$cat_title}</option>";
					
				}

			?>	
		</select>	
	</div>
	
	
	
	<div class="form-group">
	
		<label for="users">Users</label>
	
		<select name="post_user" id="">
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
		<label for="title">Post Author</label>
		<input type="text" class="form-control" name="author">
	</div>	-->
	
	
	
	<div class="form-group">
		<select name='post_status' id=''>
			<option value="draft">Post Status</option>
			<option value="published">Published</option>
			<option value="draft">Draft</option>
		</select>
	</div>	
	
	
	
	
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
	</div>	
	
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags">
	</div>	
	
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
	</div>	
	
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_post" value="PublishPost">
	</div>	
	
</form>
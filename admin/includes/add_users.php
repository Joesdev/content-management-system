<?php
	// check button press
	if(isset($_POST['create_user'])){
		
		$input_username = $_POST['input_username'];
		$input_firstname = $_POST['input_firstname'];
		$input_lastname = $_POST['input_lastname'];
		$input_role = $_POST['input_role'];
		
		$input_image = $_FILES['input_image']['name'];
		$input_image_temp = $_FILES['input_image']["tmp_name"];
		
		$input_email = $_POST['input_email'];
		$input_password = $_POST['input_password'];
		
		// Move Picture from temporary server space to actual.
		
		if(!move_uploaded_file($input_image_temp , "../images/$input_image")){
			echo "File failed to upload.";
		}
		
		$query = "INSERT INTO users (user_name, user_firstname, user_lastname, user_role
					, user_image, user_email, user_password ) ";
		$query .= "VALUES('{$input_username}', '{$input_firstname}', '{$input_lastname}', '{$input_role}', '{$input_image}', '{$input_email}','{$input_password}' )" ;
		
		$create_user_query = mysqli_query($connection, $query);
		
		confirmQuery($create_user_query);
		
	}

?>


<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="">Username</label>
		<input type="text" class="form-control" name="input_username">		
		</div>
		
		<div class="form-group">
		<label for="">Firstname</label>
		<input type="text" class="form-control" name="input_firstname">
	</div>	
	
	<div class="form-group">
		<label for="">Lastname</label>
		<input type="text" class="form-control" name="input_lastname">
	</div>	
			
	<div class="form-group">
		<select name="input_role" id="">
			<option value="Subscriber">Select Option</option>
			<option value="Admin">Admin</option>
			<option value="Subscriber">Subscriber</option>
		
		</select>	
	</div>
	
	<div class="form-group">
		<label for="">User Image</label>
		<input type="file" name="input_image">
	</div>	
	
	<div class="form-group">
		<label for="">Email</label>
		<input type="email" class="form-control" name="input_email">
	</div>	
	
	<div class="form-group">
		<label for="">Password</label>
		<input type="password" class="form-control" name="input_password">
	</div>	
	
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_user" value="Create">
	</div>	
	
</form>
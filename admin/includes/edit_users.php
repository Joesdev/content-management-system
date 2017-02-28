<?php
	if(isset($_GET['edit_user'])){
		
		$the_user_id = $_GET['edit_user'];
		
		$query = "SELECT * FROM users WHERE user_id = $the_user_id ";
		$select_users_query = mysqli_query($connection, $query);
		while($row = mysqli_fetch_assoc($select_users_query)){
			$user_id = $row['user_id'];
			$user_name = $row['user_name'];
			$user_password = $row['user_password'];
			$user_firstname = $row['user_firstname'];
			$user_lastname = $row['user_lastname'];
			$user_email = $row['user_email'];
			$user_image = $row['user_image'];
			$user_role = $row['user_role'];

		}
	}
	





	// Update On Button Click
	if(isset($_POST['edit_user'])){
		
		$user_name = $_POST['input_username'];
		$user_firstname = $_POST['input_firstname'];
		$user_lastname = $_POST['input_lastname'];
		$user_role = $_POST['input_role'];
		
		/*$input_image = $_FILES['input_image']['name'];
		$input_image_temp = $_FILES['input_image']["tmp_name"];
		*/
		$user_email = $_POST['input_email'];
		$user_password = $_POST['input_password'];
		
		
		
		$query = "SELECT user_randSalt FROM users" ;
		$select_randsalt_query = mysqli_query($connection, $query);

		if(!$select_randsalt_query){
			die('QUERY FAILED!' . mysqli_error($connection));
		}
		$row = mysqli_fetch_assoc($select_randsalt_query);
		$salt = $row['user_randSalt'];
		$hashed_password = crypt($user_password, $salt);
		
		
		
		$query = "UPDATE users SET ";
		$query .= "user_firstname = '{$user_firstname}', ";
		$query .= "user_lastname = '{$user_lastname}', ";
		$query .= "user_role = '{$user_role}', ";
		$query .= "user_name = '{$user_name}', ";
		$query .= "user_email = '{$user_email}', ";
		$query .= "user_password = '{$hashed_password}' ";
		$query .= "WHERE user_id = '{$the_user_id}'";
		
		$edit_user_query = mysqli_query($connection, $query);
		confirmQuery($edit_user_query);
		
		}

?>


<form action="" method="POST" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="">Username</label>
		<input type="text" value ="<?php echo $user_name; ?>" class="form-control" name="input_username">		
		</div>
		
		<div class="form-group">
		<label for="">Firstname</label>
		<input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="input_firstname">
	</div>	
	
	<div class="form-group">
		<label for="">Lastname</label>
		<input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="input_lastname">
	</div>	
			
	<div class="form-group">
		<select name="input_role" id="">
			<option value="Subscriber"><?php echo $user_role; ?></option>
			
			<?php 
				if($user_role == 'Admin'){
					echo "<option value = 'Subscriber'> Subscriber </option>";
				} else {
					echo "<option value = 'Admin'> Admin </option>";
				}
					
			?>
		
		</select>	
	</div>
	
	<div class="form-group">
		<label for="">User Image</label>
		<input type="file" name="input_image">
	</div>	
	
	<div class="form-group">
		<label for="">Email</label>
		<input type="email" value="<?php echo $user_email; ?>" class="form-control" name="input_email">
	</div>	
	
	<div class="form-group">
		<label for="">Password</label>
		<input type="password" value="<?php echo $user_password; ?>" class="form-control" name="input_password">
	</div>	
	
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="edit_user" value="Edit">
	</div>	
	
</form>
<?php include "db.php" ;?>
<?php session_start() ;?>


<?php 
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// Clean Inputs, This is a Security Measure
		$username = mysqli_real_escape_string($connection, $username);
		$password = mysqli_real_escape_string($connection, $password);
		
		$query = "SELECT * FROM users WHERE user_name = '{$username}' ";
		$select_user_query = mysqli_query($connection, $query);
		
		// Check Query For Errors
		if(!$select_user_query){
			die("There is an error in login.php " . mysqli_error($connection));
		}
		
		// Retreive All Rows
		while($row = mysqli_fetch_array($select_user_query)){
			$db_id = $row['user_id'];
			$db_username = $row['user_name'];
			$db_firstname = $row['user_firstname'];
			$db_lastname = $row['user_lastname'];
			$db_password = $row['user_password'];
			$db_role = $row['user_role'];
		}
		
		$password = crypt($password, $db_password);
		
		// Re-direct to Admin if Login Info Exists
		if($username === $db_username && $password === $db_password ){
			// Save Information for Multiple Pages
			$_SESSION['username'] = $db_username;
			$_SESSION['firstname'] = $db_firstname;
			$_SESSION['lastname'] = $db_lastname;
			$_SESSION['role'] = $db_role;
			header("Location: ../admin");
		} else {
			header("Location: ../index.php");
		}
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>
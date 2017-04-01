<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php 
	if(isset($_POST['submit'])){
		
		$username = $_POST['username'];
		$email    = $_POST['email'];
		$password = $_POST['password'];
		
		if(!empty($username) && !empty ($email) && !empty ($password)){

			// Clean up input for security
			$username = mysqli_real_escape_string($connection, $username);
			$email    = mysqli_real_escape_string($connection, $email);
			$password = mysqli_real_escape_string($connection, $password);
			
			
			$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12) );
			
			$query = "INSERT INTO users (user_name, user_email, user_password, user_role) ";
			$query .= "VALUES ('{$username}', '{$email}', '{$password}', 'subscriber') ";
			$register_user_query = mysqli_query($connection, $query);
			
			if(!$register_user_query){
				die('QUERY FAILED!' . mysqli_error($connection));
			}

			$message = "Account Created!";

		} else {
			$message = "Fields Cannot Be Empty.";
		}
		
	} else {
		$message = "";
	}
?> 
 


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact Page</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Subject</label>
                            <input type="subject" name="subject" id="subject" class="form-control" placeholder="What's The Subject?">
                        </div>
                         <div class="form-group">
                            <textarea class="form-control" name="body" id="body"></textarea>
                            
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>

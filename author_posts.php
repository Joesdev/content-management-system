<?php session_start() ;?>
<?php include "includes/db.php";?>
<?php include "includes/header.php" ;?>
<?php include "admin/functions.php" ;?>

    <!-- Navigation -->
    
	<?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php 
	
					if(isset($_GET['p_id'])){
						$clicked_post_id     = $_GET['p_id'];
						$clicked_post_user = $_GET['user'];
					}
	
					
					$query = "SELECT * FROM posts WHERE post_user = '{$clicked_post_user}' ";
					$queryAllPosts = mysqli_query($connection, $query);

					// Retreive row , print out value as a nav link
					while($row = mysqli_fetch_assoc($queryAllPosts)){
						$post_title = $row['post_title'];
						$post_user = $row['post_user'];
						$post_date = $row['post_date'];
						$post_image = $row['post_image'];
						$post_content = $row['post_content'];
						
						echo "<li><a href='#'>{$post_title}</a></li>";
				?>
						
						<h1 class="page-header">
							Page Heading
							<small>Secondary Text</small>
						</h1>

						<!-- First Blog Post -->
						<h2>
							<a href="#"><?php echo $post_title ?></a>
						</h2>
						<p class="lead">
							By <?php echo $post_user ;?>
						</p>
						<p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?> </p>
						<hr>
						<img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
						<hr>
						<p><?php echo $post_content ?></p>
						
				
					<?php } ?>
					
					
					                <!-- Blog Comments -->
					                
					<?php
						// On Comment Submit Click
						if(isset($_POST['commented_submit'])){
								// Collect Data From Form
								$clicked_post_id = $_GET['p_id'];
								$commented_author = $_POST['commented_author'];
								$commented_email = $_POST['commented_email'];
								$commented_content = $_POST['commented_content'];

								if(!empty($commented_author) && !empty($commented_email) &&              				!empty($commented_content)) {
									$query = "INSERT INTO comments (comment_post_id, comment_Author,
										comment_email, comment_content, comment_status, comment_date)";
									$query .= "VALUES ($clicked_post_id, '{$commented_author}', '{$commented_email}',
										'{$commented_content}', 'Unapproved', now())";

									// Send Query to Insert Data
									$create_comment_query = mysqli_query($connection, $query);

									confirmQuery($create_comment_query);


									$query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
									$query .= "WHERE post_id = $clicked_post_id ";

									$update_comment_count = mysqli_query($connection, $query);
									confirmQuery($update_comment_count);
								}else {
									echo "<script>alert('It Seems You Didn\'t Type Anything, Try Again'); </script>";
								}
							}// end outer if
				
				
					?>
					          
                <!-- Comment -->
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
        	<?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
        
<?php include "includes/footer.php" ?>        

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
						$clicked_post_id = $_GET['p_id'];
					}
	
					
					$query = "SELECT * FROM posts WHERE post_id = {$clicked_post_id} ";
					$queryAllPosts = mysqli_query($connection, $query);

					// Retreive row , print out value as a nav link
					while($row = mysqli_fetch_assoc($queryAllPosts)){
						$post_title = $row['post_title'];
						$post_author = $row['post_author'];
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
							by <a href="index.php"><?php echo $post_author ?></a>
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
						}
				
				
					?>
					                
					                
					                
					                
					                

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                       
                       <div class="form-group">
                       		<label name="Author">Author</label>
						    <input type="text" class="form-control" name="commented_author">
                        </div>
                        
                        <div class="form-group">
                        	<label name="Email">Email</label>
						    <input type="email" class="form-control" name="commented_email">
                        </div>
                       
                       
                        <div class="form-group">
                            <label name="Comment">Your Comment</label>
                            <textarea class="form-control" name="commented_content" rows="3"></textarea>
                        </div>
                        <button type="submit"name="commented_submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                
                <?php
				
					$query = "SELECT * FROM comments WHERE comment_post_id = {$clicked_post_id} ";
					$query .= "AND comment_status = 'approved' ";
					$query .= "ORDER BY comment_id DESC ";
				
					$select_comment_query = mysqli_query($connection, $query);
					confirmQuery($select_comment_query);
				
					while($row = mysqli_fetch_assoc($select_comment_query)){
						$comment_date = $row['comment_date'];
						$comment_content = $row['comment_content'];
						$comment_author = $row['comment_author'];
						
						// Loop is open
						?> 
              
					  <!-- Comment -->
					  <div class="media">
							<a class="pull-left" href="#">
								<img class="media-object" src="http://placehold.it/64x64" alt="">
							</a>
							<div class="media-body">
								<h4 class="media-heading"><?php echo $comment_author; ?>
									<small><?php echo $comment_date; ?></small>
								</h4>
								<?php echo $comment_content; ?>
							</div>
						</div>
              
              <?php } ?>

                <!-- Comment -->
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
        	<?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
        
<?php include "includes/footer.php" ?>        

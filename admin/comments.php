<?php include "includes/admin_header.php"?>

<div id="wrapper">

	<!-- Navigation -->
	<?php include "includes/admin_navigation.php" ?>

	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
			
			
				<?php ?>
				<div class="col-lg-12">
				
					<h1 class="page-header">
						<small>"Do or do not, there is no try" -Yoda</small>
					</h1>
					
					<?php
						if(isset($_GET['source'])){
							$source = $_GET['source'];
						} else {
							$source = '';
						}
						
						switch($source){
							case 'add_post';
								include "includes/add_post.php";
								break;
							case 'edit_post';
								include "includes/edit_post.php";
								break;
							case 'view_all_comments';
								include "includes/view_all_comments.php";
								break;
							case 'view_selected_comments';
								include "includes/view_selected_comments.php";
								break;
							default:
								include "includes/view_all_comments.php";
								break;
								
						}
				
	
					?>
					
					
					
				</div>
				
			</div>
			<!-- /.row -->

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>

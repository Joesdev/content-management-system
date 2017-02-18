						<form action="" method="post">
							<div class="form-group">
								<label for="cat_title"> Edit Category</label>
								<?php
									//Query server to edit a category
									
									if(isset($_GET['edit'])){
										$edit_cat_id = $_GET['edit'];
										$query = "SELECT * FROM categories WHERE cat_id = $edit_cat_id ";
										$select_cat_id = mysqli_query($connection, $query);
										
										while($row = mysqli_fetch_assoc($select_cat_id)){
											$cat_id = $row['cat_id'];
											$cat_title = $row['cat_title'];
											
								?>
									<input value = "<?php if(isset($cat_title)){echo $cat_title;} ?>" class="form-control" type ="text" name="cat_title">
									
								<?php } } ?>
									
								<?php 
									//Update Query
									if(isset($_POST['update_category'])){
											$selected_cat_title = $_POST['cat_title'];
											$query = "UPDATE categories SET cat_title = '{$selected_cat_title}' WHERE cat_id = {$cat_id} ";
											$update_cat_query = mysqli_query($connection, $query);
											if(isset($update_cat_query)){
												echo" Succesful";
											}
									}
								?>

							</div>
						<div class="form-group">
								<input class="btn btn-primary" type ="submit" name="update_category" value="Update">
							</div>

						</form>
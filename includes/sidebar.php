<?php //include "db.php" ?>

			
 			<div class="col-md-4">			     
               
                <!-- Blog Search Well -->
                <div class="well">
                   <form action="search.php" method="post"> 
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input name ="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
					</form> <!-- Search Form-->
                    <!-- /.input-group -->
                </div>
                
                
                 <!-- Login -->
                <div class="well">
                   <form action="includes/login.php" method="post"> 
						<h4>Login</h4>
						<div class="form-group">
							<input name ="username" type="text" class="form-control" placeholder="Enter Username">
						</div>
						<div class="input-group">
							<input name ="password" type="password" class="form-control" placeholder="Enter Password">
								<span class="input-group-btn">
									<button class="btn btn-primary" name="login" type="submit">Login
									</button>
								</span>
						</div>
					</form>
                </div>
                
                <!-- Blog Categories Well -->
                <div class="well">
                   
                   <?php
					
					// Query server for category info
					$query = "SELECT * FROM categories ";
					$queryAllCategory = mysqli_query($connection, $query);
					
					?>
                   
                   
                   
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            
                            	<?php
                            	// Retreive Row, Print as Nav Link
									while($row = mysqli_fetch_assoc($queryAllCategory)){
										$cat_title = $row['cat_title'];
										$cat_id = $row['cat_id'];
										echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
									}
								?>
                           
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php" ?>

            </div>
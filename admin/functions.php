<?php	
	// Shows error on failed query
	function confirmQuery($result){
		global $connection;
		if(!$result){
			die("Query Failed" . mysqli_error($connection));
			//return false;
		} else{
			//return true;
		}
		
	}

	// Create category based on user input
	function insert_categories(){
		
		global $connection;
		
		// check for button push
		if(isset($_POST['submit'])){
			//save the input
			$cat_title = $_POST['cat_title'];
			//check if input is empty
			if(empty($cat_title)){
				echo "Listen, buddy, we both know you didn't type anything.";
			} else {
				//save input as new category in database
				$query = "INSERT INTO categories(cat_title) "; //row
				$query .= "VALUE('{$cat_title}')";// input field value
				$create_category_query = mysqli_query($connection, $query);

				// Check if query working
				if(!$create_category_query){
					die("Query Failed" . mysqli_error($connection));
				}
			}// end else
		}// if
	}

	// Find + Display Category Data in Table
	function find_All_Categories(){
		
		global $connection;
		
		$query = "SELECT * FROM categories ";
		$select_Category_Table = mysqli_query($connection, $query);

		// Show Dynamic Category Data in a table
		while($row = mysqli_fetch_assoc($select_Category_Table)){
			$cat_id = $row['cat_id'];
			$cat_title =$row['cat_title'];
			echo "<tr>";
			echo "<td>{$cat_id}</td>";
			echo "<td>{$cat_title}</td>";
			echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
			echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
			echo "</tr>";
		}
		
	}

	// Delete Category base on ID
	function delete_Category(){
		
		global $connection;
		
		if(isset($_GET['delete'])){
			$delete_id = $_GET['delete'];
			$query = "DELETE FROM categories WHERE cat_id = {$delete_id} ";
			$del_cat_query = mysqli_query($connection, $query);
			header("Location: categories.php");
		}
	}


?>
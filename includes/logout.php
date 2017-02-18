<?php session_start() ;?>


<?php 
	// Cancel the Active Sessions
	$_SESSION['username'] = null;
	$_SESSION['firstname'] = null;
	$_SESSION['lastname'] = null;
	$_SESSION['role'] = null;

	header("Location: ../index.php");

?>
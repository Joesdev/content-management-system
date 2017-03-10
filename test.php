<?php 
	// Larger Number is, slower hash will work (delay)

	// Parameters: password , algorithm, options
	echo password_hash('secret', PASSWORD_BCRYPT, array('cost' => 12) ); 
	phpinfo();

?>
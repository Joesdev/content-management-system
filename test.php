<?php 
	// Larger Number is, slower hash will work (delay)
	echo password_hash('secret', PASSWORD_DEFAULT, array('cost' => 10) ); 
	phpinfo();

?>
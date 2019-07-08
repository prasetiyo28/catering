<?php 
 	$server		= "103.28.12.49"; //sesuaikan dengan nama server
	$user		= "pluginid_ctrng"; //sesuaikan username
	$password	= "Informatika123"; //sesuaikan password
	$database	= "pluginid_catering"; //sesuaikan target databese


	$con = mysqli_connect($server, $user, $password, $database);
	if (mysqli_connect_errno()) {
		echo "Gagal terhubung MySQL: " . mysqli_connect_error();
	}

	?>
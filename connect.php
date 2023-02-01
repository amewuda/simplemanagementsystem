<?php
	$connection = mysqli_connect('localhost', 'root', '', 'cms');
	if(!$connection){
		echo 'Connection error: ' . mysqli_connect_error();
		echo "Error: Unable to connect to MYSQL." .PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	// if(mysqli_connect_errno()){
	// 	//Connection Failed
	// 	echo 'Failed to connect to MYSQL' . mysqli_connect_errno();
	// }
?>
<?php

	$db = mysqli_connect("localhost", "root", "", "newsportal");

	if($db){

		//echo "Database Connected";
	}
	else{

		die("Database connection failed!" . mysqli_error($db));
	}
?>
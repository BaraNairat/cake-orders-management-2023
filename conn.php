<?php
	$con = mysqli_connect("localhost","root","") or die("Server Error");
	mysqli_select_db($con , "cakedb") or die( "Database not found" );	
	mysqli_query($con , 'SET CHARACTER SET utf8' );
?>
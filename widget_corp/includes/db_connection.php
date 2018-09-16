<?php
	
	// 1. Create a databse connection
	// Define constants instead of variables
	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "widget_corp");
	$connection = mysqli_connect( DB_SERVER , DB_USER, DB_PASS, DB_NAME);
	/*
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "widget_corp";
	
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	*/
	// Test if connection occurred.
	if(mysqli_connect_errno()){
		die("Database connetion Failed: " . mysqli_connect_erorr() . " (" . mysqli_connect_errno() . ")" ); 
	}
	
	/* $connection = mysqli_connect("localhost", "root", "","widget_corp" ) or die("connection error"); */
?>
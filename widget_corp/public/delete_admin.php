<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	$admin = find_admin_by_id($_GET["id"]);
	if(!$admin){
		// admin ID is missing or invalid or
		// admin couldn't found in database
		redirect_to("manage_admins.php");
	}
	$id = $admin["id"];
	$query = "DELETE FROM admins WHERE id = {$id} LIMIT 1";
	$result = mysqli_query($connection, $query);
		// Test if there was a query error
		if($result && mysqli_affected_rows($connection) == 1){
			// Success
			$_SESSION["message"]  = "Admin Deleted.";
			redirect_to ("manage_admins.php"); 
		} else{
			// Failure or 
			$message = "Admin Deletion failed.";
			redirect_to ("manage_admins.php"); 
		}
	
?>
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>

<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	$current_page = find_page_by_id($_GET["page"] , false);
	if (!$current_page) {
		// page ID is missing or invalid or
		// page couldn't found in database
		redirect_to("manage_content.php");
	} 

	$id = $current_page["id"];
	$query = "DELETE FROM pages WHERE id = {$id} LIMIT 1";
	$result = mysqli_query($connection, $query);
		// Test if there was a query error
		if($result && mysqli_affected_rows($connection) == 1){
			// Success
			$_SESSION["message"]  = "Page deleted. ";
			redirect_to ("manage_content.php"); 
		} else{
			// Failure or 
			$_SESSION["message"] = "Page deletion failed.";
			redirect_to ("manage_content.php?subject={$id}"); 
		}
?>
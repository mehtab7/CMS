<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("../includes/validation_functions.php") ?>
<?php find_selected_page(); ?>
<?php
	if (!$current_subject) {
		// subject ID is missing or invalid or
		// subject couldn't found in database
		redirect_to("manage_content.php");
	}
?>
<?php
if(isset($_POST['submit'])) {
	// Process the form
		// often these are form values in $_POST
	// Escape string is used here as a function
	// 2. Perform dtabase query
	// validations
	$required_fields = array("menu_name" , "position" , "visible");
	validate_presences($required_fields);

	$fields_with_max_lengths = array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);

	if(empty($errors)) {
		// perform the update
		$id = $current_subject["id"];
		$menu_name = mysql_prep($_POST["menu_name"]);
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];

		$query = "UPDATE subjects SET ";
		$query .= " menu_name = '{$menu_name}', ";
		$query .= "position = {$position}, ";
		$query .= "visible = {$visible} ";
		$query .= "WHERE id = {$id} ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);
		// Test if there was a query error
		if($result && mysqli_affected_rows($connection) >= 0){
			// Success
			$_SESSION["message"]  = "Subject updated.";
			redirect_to ("manage_content.php"); 
		} else{
			// Failure or 
			$message = "Subject update failed.";
		}
	}
	}else{
		// This is probably a GET request
	} // end: if(isset($_POST['submit']))


?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>



<div>
	<div class="row">
		<div class="col-md-3"  style="background-color:brown; height: 580px; padding-top: 20px;">
			<?php echo navigation( $current_subject , $current_page ); ?>
		</div>
		<div class="col-md-9">
			<?php // $message is just a variable doesn't use the SESSION 
			if(!empty($message)) {
				echo "<div class=\"message\">" . htmlentities($message) . "</div>" ; 
			}
			
			?>
			<?php echo form_errors($errors); ?>
			<div style="margin-top: 20px;">
				<h2>Edit Subject: <?php echo htmlentities($current_subject["menu_name"]);  ?></h2>
				<form action="edit_subject.php?subject=<?php echo  urlencode($current_subject["id"]); ?>" method="post">
					<p>Subject Name:<input class="form-group type="text" name="menu_name" value="<?php echo htmlentities($current_subject["menu_name"]); ?>"></p>
					<p>Position: 
						<select name="position">
							<?php
							$subject_set = find_all_subjects(false);
							$subject_count = mysqli_num_rows($subject_set);
							for ($count=1; $count <= $subject_count ; $count++) { 
								echo "<option value=\"{$count}\"";
								if($current_subject["position"] == $count){
									echo " selected";
								}
								
								echo ">{$count}</option>";
							}

							?>
							
						</select>
					</p>
					<p>Visible:
					<input type="radio" name="visible" value="0" <?php if ($current_subject["visible"] == 0){ echo "checked";} ?> /> No
					&nbsp
					<input type="radio" name="visible" value="1" <?php if ($current_subject["visible"] == 1){ echo "checked";} ?> /> Yes
					</p>
					<input type="submit" name="submit" value="Edit Subject" />
				</form>
				<br>
				<a href="manage_content.php">Cancel</a>
				&nbsp;
				&nbsp;
				<a href="delete_subject.php?subject=<?php echo urlencode($current_subject["id"]) ?>" onclick = "return confirm('Are you sure.')" >Delete</a>

			</div>
		</div>
	</div>
	
</div>

<?php include("../includes/layouts/footer.php") ?>

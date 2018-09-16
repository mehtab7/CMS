<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("../includes/validation_functions.php") ?>
<?php find_selected_page(); ?>
<?php
	// Unlike new_page.php, we don't need a subject_id to be sent
	// we already have it stored in pages.subject_id
	if (!$current_page) {
		// subject ID is missing or invalid or
		// subject couldn't found in database
		redirect_to("manage_content.php");
	}
?>
<?php
if(isset($_POST['submit'])) {
	// Process the form

	$id = $current_page["id"];
	$menu_name = mysql_prep($_POST["menu_name"]);
	$position = (int) $_POST["position"];
	$visible = (int) $_POST["visible"];
	$content = mysql_prep($_POST["content"]);

	// validations
	$required_fields = array("menu_name" , "position" , "visible" , "content");
	validate_presences($required_fields);

	$fields_with_max_lengths = array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);

	if(empty($errors)) {
		
		$query = "UPDATE pages SET ";
		$query .= "menu_name = '{$menu_name}', ";
		$query .= "position = {$position}, ";
		$query .= "visible = {$visible}, ";
		$query .= "content = '{$content}' " ;
		$query .= "WHERE id = {$id} ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);
		// Test if there was a query error
		if($result && mysqli_affected_rows($connection) == 1){
			// Success
			$_SESSION["message"]  = "Page updated.";
			redirect_to ("manage_content.php?page={$id}"); 
		} else{
			// Failure or 
			$message = "Page update failed.";
		}
	}
	}else{
		// This is probably a GET request
	} // end: if(isset($_POST['submit']))


?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

	<div class="row">
		<div class="col-md-3"  style="background-color:brown; height: 670px; padding-top: 20px;">
			<?php echo navigation( $current_subject , $current_page ); ?>
		</div>
		<div class="col-md-9">

			<?php echo message(); ?>
			<?php echo form_errors($errors); ?>

			<div style="margin-top: 20px;">

				<h2>Edit Page: <?php echo htmlentities($current_page["menu_name"]);  ?></h2>
				<form action="edit_page.php?page=<?php echo  urlencode($current_page["id"]); ?>" method="post">
					<p>Menu Name:<input class="form-group type="text" name="menu_name" value="<?php echo htmlentities($current_page["menu_name"]); ?>"></p>
					<p>Position: 
						<select name="position">
							<?php
							$page_set = find_pages_from_subjects($current_page["subject_id"] , false);
							$page_count = mysqli_num_rows($page_set);
							for ($count=1; $count <= $page_count ; $count++) { 
								echo "<option value=\"{$count}\"";
								if($current_page["position"] == $count){
									echo " selected";
								}
								
								echo ">{$count}</option>";
							}

							?>
							
						</select>
					</p>
					<p>Visible:
					<input type="radio" name="visible" value="0" <?php if ($current_page["visible"] == 0){ echo "checked";} ?> /> No
					&nbsp
					<input type="radio" name="visible" value="1" <?php if ($current_page["visible"] == 1){ echo "checked";} ?> /> Yes
					</p>
					<p>
						<textarea name="content" rows="20" cols="80" ><?php echo htmlentities($current_page["content"]); ?></textarea>
					</p>
					<input type="submit" name="submit" value="Edit Page" />
				</form>
				<br>
				<a href="manage_content.php?page=<?php echo urlencode($current_page["id"]); ?>">Cancel</a>
				&nbsp;
				&nbsp;
				<a href="delete_page.php?page=<?php echo urlencode($current_page["id"]) ?>" onclick = "return confirm('Are you sure.')" >Delete</a>

			</div>
		</div>
	</div>

<?php include("../includes/layouts/footer.php") ?>

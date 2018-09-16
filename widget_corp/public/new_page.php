<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("../includes/validation_functions.php") ?>

<?php find_selected_page(); ?>
<?php
	// Can't add a neww page unless we have a subject as a parent!
	if(!$current_subject) {
		// subject ID was missin or invalid or
		// subject couldn't be found in database
		redirect_to("manage_content.php");
	}
?>
<?php if(isset($_POST['submit'])){
		// Process the form

	// 2. Perform dtabase query
	// validations
	$required_fields = array("menu_name" , "position" , "visible" , "content" );
	validate_presences($required_fields);

	$fields_with_max_lengths = array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);

	if(empty($errors)) {
		// often these are form values in $_POST
		// Escape string is used here as a function
		// be sure you add the subject_id!
		$subject_id = $current_subject["id"];
		$menu_name = mysql_prep($_POST["menu_name"]);
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];
		// be sure to escape the content
		$content = mysql_prep($_POST["content"]);

		$query = "INSERT INTO pages (";
		$query .= " subject_id , menu_name, position, visible , content";
		$query .= ") VALUES (";
		$query .= " {$subject_id} , '{$menu_name}', {$position}, {$visible}, '{$content}' ";
		$query .= ")";
		$result = mysqli_query($connection, $query);
		// Test if there was a query error
		if($result){
			// Success
			$_SESSION["message"]  = "Page created.";
			redirect_to ("manage_content.php?subject=" . urlencode($current_subject["id"])); 
		} else{
			// Failure or 
			$_SESSION["message"]  = "Page creation failed.";
		}
	}
	}else{
		// This is probably a GET request
	}
?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<div>
	<div class="row">
		<div class="col-md-3"  style="background-color:brown; height: 670px; padding-top: 20px;">
			<?php echo navigation( $current_subject , $current_page ); ?>
		</div>
		<div class="col-md-9">

			<?php 
			// Session function is called
			echo message(); 
			?>

			<?php 
			// Call the errors function
			$errors = errors(); 
			?>

			<?php echo form_errors($errors); ?>

			<div style="margin-top: 20px;">
				<h2>Create  Page</h2>
				<form action="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>" method="post" class="form-group">
					<p>Menu Name:<input class="form-group type="text" name="menu_name"></p>
					<p>Position: 
						<select name="position">
							<?php
							$page_set = find_pages_from_subjects($current_subject["id"] , false);
							$page_count = mysqli_num_rows($page_set);
							for ($count=1; $count <= ($page_count + 1) ; $count++) { 
								echo "<option value=\"{$count}\">{$count}</option>";
							}

							?>
							
						</select>
					</p>
					<p>Visible:

			    	
					<input type="hidden" value="" name="visible">
					&nbsp
					<input type="radio" name="visible" value="0" /> No
					&nbsp
					<input type="radio" name="visible" value="1" /> Yes
					</p>
					<p>COntent:<br>
						<textarea name="content" rows="15" cols="80" ></textarea>
					</p>
					<input type="submit" name="submit" value="Create Page" />
				</form>
				<br>
				<a style="color: black;" href="manage_content.php?subject=<?php echo urlencode($current_subject["id"]); ?>"><button>Cancel</button></a>

			</div>
		</div>
	</div>
	
</div>
<?php include("../includes/layouts/footer.php") ?>
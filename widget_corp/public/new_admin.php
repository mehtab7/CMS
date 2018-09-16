<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("../includes/validation_functions.php") ?>

<?php 
	if(isset($_POST['submit'])){
		// Process the form
		// validations

	$required_fields = array("username" , "password");
	validate_presences($required_fields);

	$fields_with_max_lengths = array("username" => 30);
	validate_max_lengths($fields_with_max_lengths);

	if(empty($errors)) {
		// perform create

		$username = mysql_prep($_POST["username"]);
		$hashed_password = $_POST["password"];

		$query = "INSERT INTO admins ( username , hashed_password) VALUES ( '{$username}', '{$hashed_password}' ) " ;
		/*
		$query = "INSERT INTO admins (";
		$query .= " username, hashed_password";
		$query .= ") VALUES (";
		$query .= " '{$username}', ' {$hashed_password} ' ";
		$query .= ")";
		*/
		$result = mysqli_query($connection, $query);
		if($result){
			// Success
			$_SESSION["message"]  = "Admin created.";
			redirect_to ("manage_admins.php"); 
		} else{
			// Failure or 
			$_SESSION["message"]  = "Admin creation failed.";
		}
	}
	}else{
		// This is probably a GET request
	}
	?>
	<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div class="row">
	<div class="col-md-3" style="background-color:brown; height: 580px; padding-top: 20px;">
		&nbsp
	</div>
	<div class="col-md-9">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>

		<h2>Create Admin</h2>
		<form action="new_admin.php" method="post">
			<p>Username:
				<input type="text" name="username" value="" />
			</p>
			<p>Password:
				<input type="password" name="password" value="">
			</p>
			<input type="submit" name="submit" value="Create Admin">
		</form>
		<br>
		<a href="manage_admins.php">Cancel</a>
	</div>
</div>
<?php include("../includes/layouts/footer.php") ?>

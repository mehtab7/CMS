<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<?php find_selected_page(); ?>

<div>
	<div class="row">
		<div class="col-md-3"  style="background-color:brown; height: 580px; padding-top: 20px;">
			<?php echo navigation( $current_subject , $current_page ); ?>
		</div>
		<div class="col-md-9">
			<?php 
			// Session function is called
			echo message(); 
			?>
			<?php 
			// Call the errors function
			$errors = errors(); ?>
			<?php echo form_errors($errors); ?>
			<div style="margin-top: 20px;">
				<h2>Create  Subject</h2>
				<form action="create_subject.php" method="post" class="form-group">
					<p>Subject Name:<input class="form-group type="text" name="menu_name"></p>
					<p>Position: 
						<select name="position">
							<?php
							$subject_set = find_all_subjects(false);
							$subject_count = mysqli_num_rows($subject_set);
							for ($count=1; $count <= ($subject_count + 1) ; $count++) { 
								echo "<option value=\"{$count}\">{$count}</option>";
							}

							?>
							
						</select>
					</p>
					<p>Visible:
					<input type="radio" name="visible" value="0" /> No
					&nbsp
					<input type="radio" name="visible" value="1" /> Yes
					</p>
					<input type="submit" name="submit" value="Create Subject" />
				</form>
				<br>
				<a href="manage_content.php">Cancel</a>

			</div>
		</div>
	</div>
	
</div>

<?php include("../includes/layouts/footer.php") ?>

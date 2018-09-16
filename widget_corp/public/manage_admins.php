<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php") ?>
<?php require_once("../includes/functions.php") ?>
<?php confirm_logged_in(); ?>
<?php
	$admin_set = find_all_admins();
?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php") ?>

<div class="row">
	<div class="col-md-3" style="background-color:brown; height: 580px; padding-top: 20px;">
		<a href="admin.php" style="color: white;">&laquo; Main Menu</a>
	</div>
	<div class="col-md-9">
		<?php echo message();  ?>
		<h2>Manage Admins</h2>
		<table>
			<tr>
				<th style="text-align: left; width: 200px">Username</th>
				<th colspan="2" style="text-align: left;">Actions</th>
			</tr>
			<?php while($admin = mysqli_fetch_assoc($admin_set)){ ?>
			<tr>
				<td><?php echo htmlentities($admin["username"]); ?>
					<br>
					<?php echo htmlentities($admin["hashed_password"]); ?>
				</td>
				<td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">Edit | &nbsp;</a></td>

				<td><a href="delete_admin.php?id=<?php echo urlencode($admin["id"]); ?>" onclick="return confirm('Are you sure?');" > Delete</a></td>
			</tr>
			<?php } ?>
		</table>
		<br>
		<a href="new_admin.php">Add new admin</a>

	</div>
</div>
<?php include("../includes/layouts/footer.php") ?>
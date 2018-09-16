<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/functions.php") ?>
<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php") ?>
<div class="row">
	<div class="col-md-3" style="background-color:brown; height: 580px">
		
	</div>
	<div class="col-md-9">
		<div>
			<div>
				<h2>Admin Menu</h2>
				<p>Welcome to the admin area, <?php echo htmlentities($_SESSION["username"]); ?>.</p>
				<ul>
					<li>
						<a href="manage_content.php">Manage Website Content</a>
					</li>
					<li><a href="manage_admins.php">Manage Admin Users</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>



<?php include("../includes/layouts/footer.php") ?>
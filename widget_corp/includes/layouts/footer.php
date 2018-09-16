
	<div style="color: #D4E6F4;background-color: #1A446C;text-align: center; height: 60px;padding-top: 10px;">Copyright <?php echo date("Y"); ?>, Widget Corp</div>
</div>
</body>
</html>
<?php
// 5.Close database connection
	if(isset($connection)){
	mysqli_close($connection);
}
?>  
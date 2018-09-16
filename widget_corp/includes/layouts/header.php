<?php 
	if(!isset($layout_context)){
		$layout_context = "public";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<style>
		ul.subjects { padding-left: 0; list-style: none; color: white;padding-left:10px;}
		ul.pages { padding-left: 2em; list-style: square;font-weight: normal;}
		.selected {
			font-weight: bold;
		}
		div.message{
			border: 2px solid #8D0D19;
			color: 	#8D0D19; font-weight: bold;
			margin: 1em 0; padding: 1em;
				}
		.view-content {
			margin: 1em; padding: 1em ; border: 1px solid #999;
		}
		.errors {
			color: #8D0D19; border: 2px solid #8D0D19;
			margin: 1em 0; padding: 1em;
		}
		.error ul {
			padding-left: 2em;
		}
	</style>
	<title>Widget Corp <?php if($layout_context == "admin"){echo "Admin";} ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
</head>
<body>	
		<div style="background: #1A446C; height: 60px;">
			<a style="color: white;text-decoration-line: none;" href="admin.php"><p style="font-size: 35px" >Widget Corp <?php if($layout_context == "admin"){echo "Admin";} ?></p></a>
		</div>
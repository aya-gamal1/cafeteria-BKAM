<?php
require "main.php";
require "ORM.php";

// This is to  open connect with database in table orderss to get login user 
	$select_user = ORM::getInstance();
	$select_user->setTable('orderss');
	$selected_user=$select_user->select(array('user_id'=>1));//id of user will get from session
	var_dump($selected_user);


?>

<html>
	<body>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
			<link rel="stylesheet" href="style.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		</head>

	<div class="container">
		<label><B> MyOrder</B> </label>

		<table class="table table-bordered text-center">
			<th>Orderdate
			<th>Status
			<th>Amount
			<th>Action




		</table>

	</div>

	</body>
</html>

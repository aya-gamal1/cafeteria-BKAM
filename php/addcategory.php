<?php
include "validateuserlogin.php";
require "main.php";
require "ORM.php";

$rules = array(
		'categoryname'=>'required',
		
		
	);

	if(isset($_POST['submit']) and $_POST['submit']=="save")
	{
		$validator = new validator();
	
		$validator->validate($_POST, $rules);
		$error_array=$validator->errors;
	}

if($_POST and empty($error_array)){
$insert_cat = ORM::getInstance();
	$insert_cat->setTable('category');

	$value=array(
	'name' => $_POST['categoryname'],

			);

	$check=$insert_cat->insert($value);
	if ( $check)
		header("Location: http://localhost/project/php/addproduct.php");
}

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
	<form method="post" action="addcategory.php" class="form-inline">
	  <div class="form-group">
		<label for="exampleInputCategory">Category Name</label>
		<input type="text" name="categoryname" value="<?php if(isset($error_array['categoryname']))echo $_POST['categoryname'];?>" 											class="form-control1" id="exampleInputEmail1 inputError1">

				<?php if($_POST and isset($error_array['categoryname']))
					 echo "<B>"."."."</B>".$error_array['categoryname']; 
											?><br>
	</div>
		<input type='submit' name ="submit" value="save" class="btn btn-default">
	<form>
	</div>
</body>
</html>



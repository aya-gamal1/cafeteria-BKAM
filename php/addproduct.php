<?php
include "validateuserlogin.php";
require "main.php";
require "ORM.php";
	
	$rules = array(
		'product'=>'required',
		'price'=>'required'
		
	);

	if(isset($_POST['submit']) and $_POST['submit']=="save")
{
	$validator = new validator();
	
	$validator->validate($_POST, $rules);
	$validator->check('Category',$_POST['Category'],"Select a Category" );
	$validator->file('ProductPicture',$_FILES['ProductPicture'] );
	$error_array=$validator->errors;
}
	
	if($_POST and empty($error_array)){
	$category=$_POST['Category'];
	$select_category=ORM::getInstance();
	$select_category->setTable('category');
	$selected_item=$select_category->select(array('name'=>$category));
	$category=$selected_item[0]['id'];
	$category_name=$selected_item[0]['name'];

	$insert_product = ORM::getInstance();
	$insert_product->setTable('products');
	$name=rename("/var/www/html/project/image/".$_FILES['ProductPicture']['name'], "/var/www/html/project/image/".$_POST['product'].".jpg");
	$value=array(
	'name' => $_POST['product'],
	'price' => $_POST['price'],
	'image'=> $_POST['product'].".jpg",
	'category_id'=> $category,
	'status'=> "available",
	
			);


	$check=$insert_product->insert($value);
	if ( $check)
		echo "aaya";
		//redirct to the wanted page	

?>


<?php } else { ?>
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
	<a href="/project/php/addcategory.php" class="btn btn-primary pull-right" role="button">AddCategory</a><br>		
		<form method="post" action="addproduct.php"  enctype="multipart/form-data" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-1 control-label">Product:</label>
		<div class="col-sm-10">
				<input type="text" name="product"  value="<?php if(isset($error_array['product']))echo $_POST['product']; ?>"><br>
					<?php if($_POST and isset($error_array['product']))
							 echo "<B>"."."."</B>".$error_array['product']; 
													?><br>
			</div></div>
	<div class="form-group">
			<label class="col-sm-1 control-label" >Price:</label>
<div class="col-sm-10">
				<input type="number" name="price" step="0.25" value="<?php if(isset($error_array['price'])) echo $_POST['price']; ?>" ><br>
					<?php if($_POST and isset($error_array['price'])) 
							echo "<B>"."."."</B>".$error_array['price'];
												 ?><br>			
			</div></div>	
			<div class="form-group">	
			<label class="col-sm-1 control-label">Category:</label>
						<div class="col-sm-10">
				<select name="Category" >
					<option>Select a Category
				<?php $select_category=ORM::getInstance();
					$select_category->setTable('category');
					$selected_item=$select_category->select(array());
					for($i=0;$i<count($selected_item);$i++) {
					
					 ?>
					
					
					<option ><?php echo $selected_item[$i]['name']; ?>
					<?php }?>
					
					</select>

					<br>
					<?php if($_POST) echo "<B>"."."."</B>".$error_array['Category']; ?><br>
		
</div></div>


			
			<div class="form-group">
		<label class="col-sm-1 control-label">Product Picture:</label>


				<input type="file" name="ProductPicture" class="col-sm-10 " ><br>
					<?php if($_POST and isset($error_array['ProductPicture'])) echo "<B>"."."."</B>".$error_array['ProductPicture']; ?></div><br>
			
				
			
			<input type="submit" name="submit" value="save" class="btn btn-primary ">
			<input type="reset"  value="reset"  class="btn btn-primary ">

		</form>
</div>
</body>
</html>
<?php } ?>

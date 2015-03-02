<?php
include "validateuserlogin.php";

	
	$rules = array(
		'email'=>'email',
		'password'=>'required'
		
	);
	if(isset($_POST['submit']) && $_POST['submit']=="login")
{
	
	$validator = new validator();
	
	$validator->validate($_POST, $rules);
	$error_array=$validator->errors;
}



	if($_POST and empty($error_array)){

//redirect to coorect page 
		session_start();
		$_SESSION['e'] = $_POST['email'];
		header("Location:http://localhost/project/main.php");



	

?>
<?php } else { ?>
<html>
<body>

		<form method="post" action="userlogin.php"  >
			<label>E-mail</label>
				<input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];  ?>"><br>
					<?php if($_POST&&isset($error_array['email'])) echo "<B>"."."."</B>".$error_array['email']; ?><br>
			
			<label>Password</label>
				<input type="password" name="password" value="<?php if(isset($_POST['password']))echo $_POST['password']; ?>"><br>
					<?php if($_POST&&isset($error_array['password']))echo "<B>"."."."</B>".$error_array['password']; ?><br>			
			
			<input type="submit"  name="submit" value="login">


		</form>
</body>
</html>
<?php } ?>

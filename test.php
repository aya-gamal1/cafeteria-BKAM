
<?php
require 'ORM.php';
require 'main.php';
$mytest=array(
	'name'=>'ahmed',
	'where'=>'where',
	'password'=>'123'
	);
$obj=ORM::getInstance();
$obj->setTable("users");
$array=$obj->update($mytest);
var_dump($array);


?>

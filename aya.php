<html>
<body>
<?php $btntext="available"; ?>
<button id="btn" name="hosh"><?php echo $btntext; ?>
<script>





var available=document.getElementById("btn");
var x=5;
available.onclick=function(){
	
	<?php if($btntext=='available') { ?>
 	console.log(this.name);
console.log("esraa");
	available.innerHTML="unavailable";
	
	"<?php } else {?>"
console.log(this.name);
console.log("aya");
	available.innerHTML="available";
x=5;
"<?php } ?>"
}




</script>
</body>
</html>

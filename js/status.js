function ajax (query,status){
	if (window.XMLHttpRequest){
		ajaxRequest=new XMLHttpRequest();
	}
	else{
		ajaxRequest=new ActiveXObject("Microsoft.XMLHTTP");
	}
	ajaxRequest.open("POST","changestatus.php",true);
console.log(status);
	parameter="id="+query+"&status="+status;
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	ajaxRequest.send(parameter);

	ajaxRequest.onreadystatechange=function(){

	if (ajaxRequest.readyState===4&& ajaxRequest.status===200){
	response=ajaxRequest.responseText;
	var string_split=[],status;
	string_split=response.split(",");
			
	if (string_split[0]=='available')
		status='unavailable';
	else
		status='available';

	document.getElementById(parseInt(string_split[1])).value=status;
		console.log(status);

				
		

}
};
	

}

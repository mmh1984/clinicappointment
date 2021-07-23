<?php
$operation=$_POST["operation"];
$usertype=$_POST["usertype"];

if($operation=="login" && $usertype=="admin"){
	login_admin();	
	
}
if($operation=="login" && $usertype=="client"){
	login_client();	
	
}
if($operation=="logout"){
	session_start();
	session_destroy();
	unset($_SESSION["admin"],$_SESSION["client"]);
	
}
//functions
function login_admin(){
include 'connection.php';
$data=$_POST["data"];	
$username=mysqli_real_escape_string($db,$data[0]);
$userpass=mysqli_real_escape_string($db,$data[1]);

//create the query
$query=mysqli_query($db,
"SELECT * FROM tbladmin 
WHERE username='$username' AND
userpass='$userpass'");

//check if a row is returned (login was accepted)
	if(mysqli_num_rows($query) > 0) {
		session_start(); //start the session
		$_SESSION["admin"]=$username; //set the value of session["admin"]
		echo "admin";
	}	
	else{
		echo "Login failed! Check your username/password";	
	}
}

?>
<?php

$operation=$_POST["operation"];

switch($operation){
	case "saveclient":
	//check if the userid already exists
	if(username_exists()==false){ //call function username_exists();
		save_client(); //call function save_client();
	}
	else{
		echo "Error!, username is already taken";	
	}
	break;
	
	case "loginclient":
	login_client();
	break;
}

//create function to save_client
function save_client(){
//include connection.php
include "connection.php";	

//fetch the data from the POST (array)
$rowdata=$_POST['data'];
$fullname=$rowdata[0]; //fetch index 0
$phone=$rowdata[1];//fetch index 1
$address=$rowdata[2];//fetch index 2
$email=$rowdata[3];//fetch index 3
$username=$rowdata[4];//fetch index 4
$password=password_hash($rowdata[5],PASSWORD_DEFAULT);//fetch index 5
$date=date("Y")."-".date("m")."-".date("d");
//create a query
$query="INSERT INTO tblusers(fullname,phoneno,useraddress,
useremail,username,userpass,usertype,registereddate)
 VALUES('$fullname','$phone','$address','$email',
'$username','$password','client','$date')";
//execute the query	
  if(mysqli_query($db,$query)){
	echo "Registration Successful";	
  }
  else{
	echo mysqli_error($db);  
  }
}
//this function will check username from db
//it will return true(if user exists)
//it will return false(if user didnt exists)
function username_exists(){
  //include connection.php
  include "connection.php";
  $rowdata=$_POST['data'];
  $username=$rowdata[4];
  
  //create a query that will check if username is taken
  $qrystring="SELECT * FROM tblusers 
  WHERE username='$username'"; 
  $query=mysqli_query($db,$qrystring);
  //check how many rows does the query returned
  // (0=no match,1 means have match)
  if(mysqli_num_rows($query)>0){
	return true;	//taken sudah
  }
  else{
	return false;	//balum taken
  }	
  mysqli_close($db);

}
//function for user login
function login_client(){
  //include connection.php
  include "connection.php";
  $rowdata=$_POST['data'];
  $username=$rowdata[0];
  $password=$rowdata[1];
  
  //create a query that will check if username is taken
  $qrystring="SELECT * FROM tblusers 
  WHERE username='$username'"; 
  $query=mysqli_query($db,$qrystring);
  //check how many rows does the query returned
  // (0=no match,1 means have match)
  if(mysqli_num_rows($query)>0){
	while($row=mysqli_fetch_array($query)){
	  if(password_verify($password,$row[6]))
	  {
	    session_start(); //start a session
		//store username to session variable
		$_SESSION["client"]=$username;
		echo "successful";
	  }
	  else{
		echo  "Failed"; 
	  }
	}
  }
  else{
	echo "Login failed!";
  }	
  mysqli_close($db);

}
?>
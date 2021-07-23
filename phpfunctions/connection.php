<?php
$user="root"; //username for mysql
$pass=""; //password for mysql
$server="localhost"; //name of server
$database="clinicdb"; //name of database
    
$db=mysqli_connect($server,$user,$pass,$database);

if(!$db){
	die("Connection error".mysqli_connect_error());
}

?>
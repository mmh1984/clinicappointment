<?php
//start the session
session_start();

$op=$_POST["operation"];

switch($op){
	case "savebooking":
	save_booking();	
	break;

	case "loadbooking":
	load_booking();	
	break;
	
}//end of select

//function to load booking
function load_booking(){
//call the connection
include 'connection.php';
//determine who is currently logged in
$username=$_SESSION["client"];
//create a query
$query=mysqli_query($db,
"SELECT * FROM tblbooking
WHERE username='$username' 
 ORDER BY bookingdate DESC
");	

if(mysqli_num_rows($query)>0){
//if there is a booking for the logged user	
	echo "<div class='well'><h2>Your bookings</h2>
	<table class='table table-responisve'>
	<tr>
		<th>Date</th>
		<th>Time</th>
		<th>Branch</th>
		<th>Description</th>
		<th>Option</th>
	</tr>
	";
	while($x=mysqli_fetch_array($query)){
		echo "<tr>
			<td>$x[1]</td>
			<td>$x[2]</td>
			<td>$x[3]</td>
			<td>$x[4]</td>
			<td><button class='btn' 
			onclick='edit_booking($x[0]'>Edit</button></td>
		</tr>
		";		
	}
	echo "</table></div>";
}	
else{
//no bookings (past and future)	

echo "<div class='well'>No bookings</div>";
	
}

}

//function to save booking
function save_booking(){
  include "connection.php";
  $data=$_POST["data"];
  
  $dateselected=strtotime($data[0]); //convert string to date
  $today=strtotime(date('d-m-Y'));  //convert todays date
  $diff= ($dateselected-$today)/86400; //86400=24*60*60
  
  //check if the booking is 3 days after todays date:
  if($diff<3){
   echo "Error, you cannot book this date (3 days on today's date)";	
  }
  else{
   //convert the date selected to Y-m-d 
   $newdate=date("Y-m-d",$dateselected);
   $username=$_SESSION["client"];
   $query=mysqli_query($db,
   "INSERT INTO tblbooking
   (bookingdate,bookingbranch,
   bookingtime,description,username) 
   VALUES('$newdate','$data[1]',
   $data[2],'$data[3]','$username')");
   
   if($query){
	echo "successful";   
   }
   else{
	echo mysqli_error($db);   
   }
  }
}//end if function

?>
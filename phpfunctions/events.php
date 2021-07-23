<?php
$op=$_POST["operation"];

switch($op){

case "viewevents":
view_events();
break;	

case "eventdetails":
event_details();
break;	
	
case "upload":
upload_photo();
break;
}

function upload_photo(){
$img=$_FILES["image"]["name"];
$file="../images/events/".basename($img); //file to be uploaded
echo $_FILES["image"]["size"]; //get the size of the file
if($_FILES["image"]["size"]>2000000){  //check if file is larger than 2mb
	echo "Error.image must be less than 2mb";
}
else if($_FILES["image"]["error"]!="01"){ //01 is error code for upload
//upload file if it is less than 2mb
move_uploaded_file($_FILES["image"]["tmp_name"],$file); //upload
echo "Success";

include 'connection.php';

}

else{ 
echo $_FILES["img"]["error"];
}
	
}
function event_details(){
include "connection.php";
$id=$_POST["id"];
$query=mysqli_query($db,"SELECT * FROM tblevents WHERE eventid=$id");

while($row=mysqli_fetch_array($query)){
echo "<div class='jumbotron'>
		<div class='pull-right'>
			<button class='btn btn-primary btn-sm' onClick='add_photos($row[0])'>Add photos</button>
		</div>
		
		<h2>$row[1]</h2>
		<h4 class='label label-info'>Post ID: <span id='postid'>$row[0]</span></h4>
		<p class='text-muted text-sm'>
		$row[2]
		</p>
		<p class='badge text-sm'>$row[3]</p>
		
		</div>

</div>";	
	
}	
mysqli_close($db);
}
function view_events(){
	include "connection.php";
$query=mysqli_query($db,"SELECT * FROM tblevents ORDER BY eventid DESC");
//create the div,table and header tables
echo "<div class='well'>
      <h2>List of Events</h2>
	  <button class='btn btn-default pull-right' onclick='window.location.href=\"adddoctors.php\"'>+</button>
     <table class='table table-responsive table-striped'>
	 <tr>
	   <th>Event Name</th>
	   <th>Details</th>
	   <th>Date Posted</th>
	   <th>Option</th>
	 </tr>";
while($row=mysqli_fetch_array($query)){
	echo "<tr>
	     
	      <td>$row[1]</td>
		   <td>$row[2]</td>
		    <td>$row[3]</td>
			
			<td><button onclick='view_event($row[0])'>View</button></td>
		 </tr>";
}
//close the table and the div
echo "</table></div>";
mysqli_close($db);
	
}


?>
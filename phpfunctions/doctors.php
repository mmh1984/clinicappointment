<?php
$operation=$_POST['operation'];
switch($operation){ //start of select
	case "savedoctor":
	 if(doctor_exists()==false){
	   save_doctor();
	 }
	 else{
	   echo "Error,This doctor is already added to the system";	 
	 }	
	break;	
	
	case "viewdoctors":
	doctor_list();
	break;
	
	case "doctorselected":
	doctor_selected();
	break;
	
	case "updatedoctor":
	update_doctor();
	break;
	
	case "deletedoctor":
	delete_doctor();
	break;
	
		
}//end of select
function delete_doctor(){
 include 'connection.php';
  $id=$_POST['did'];
  $query=mysqli_query($db,"DELETE FROM
  tbldoctors WHERE doctorid=$id");
  
	if(!$query){
		echo "Error ". mysqli_error($db);	
	}
	else{
		echo "Success";
	}
	
}
function update_doctor(){
  include 'connection.php';
  $id=$_POST['id'];
  $data=$_POST["rows"];
  $query=mysqli_query($db,"UPDATE tbldoctors SET
  doctorname='$data[0]',specialty='$data[1]',
  gender='$data[2]',religion= '$data[3]',nationality= '$data[4]',image='$data[5]'
  WHERE doctorid=$id");
  
  if($query){
	echo "Update successfull";  
  }
  else{
	echo die(mysqli_error($db));  
  }
	
}//end of function

function doctor_selected(){
include 'connection.php';
$id=$_POST["doctorid"];	
$query=mysqli_query($db,"SELECT * FROM 
tbldoctors WHERE doctorid=$id");

$result[]=array();//array of row
while($row=mysqli_fetch_array($query)){
  $result[0]["name"]=$row[1];
  $result[0]["special"]=$row[2];
  $result[0]["gender"]=$row[3];	
  $result[0]["religion"]=$row[4];	
  $result[0]["nationality"]=$row[5];
  $result[0]["image"]=$row[6];
}
echo json_encode($result);
}//end of function

//function that will load table of doctors
function doctor_list(){
include "connection.php";
$query=mysqli_query($db,"SELECT * FROM tbldoctors");
//create the div,table and header tables
echo "<div class='well'>
      <h2>List of Doctors</h2>
	  <button class='btn btn-default pull-right' onclick='window.location.href=\"adddoctors.php\"'>+</button>
     <table class='table table-responsive table-striped'>
	 <tr>
	   <th>Photo</th>
	   <th>Name</th>
	   <th>Specialty</th>
	   <th>Gender</th>
	   <th>Religion</th>
	   <th>Nationality</th>
	   <th>Option</th>
	 </tr>";
while($row=mysqli_fetch_array($query)){
	echo "<tr>
	       <td><img src='$row[6]' width='80px' class='img img-responsive img-thumbnail'/></td>
	      <td>$row[1]</td>
		   <td>$row[2]</td>
		    <td>$row[3]</td>
			 <td>$row[4]</td>
		    <td>$row[5]</td>
			<td><button onclick='edit_doctor($row[0])'>Edit</button></td>
		 </tr>";
}
//close the table and the div
echo "</table></div>";
mysqli_close($db);
}//end of function


function doctor_list1(){
include "connection.php";
$query=mysqli_query($db,"SELECT * FROM tbldoctors");
//create the div,table and header tables

while($row=mysqli_fetch_array($query)){
	echo "<div class='row articles'>
    <div class='col-sm-6 col-md-4 item well'><a href='#'><img class='img-fluid' src='desk.jpg' /></a>
        <h3 class='name'>Article Title</h3>
        <p class='description'>Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href='#' class='action'><i class='fa fa-arrow-circle-right'></i></a></div>
    

    </div>
    ";
}
//close the table and the div

mysqli_close($db);
}//end of function

function doctor_exists(){
  //include connection.php
  include "connection.php";
  $rowdata=$_POST['data'];
  $name=$rowdata[0];
  
  //create a query that will check if username is taken
  $qrystring="SELECT * FROM tbldoctors 
  WHERE doctorname='$name'"; 
  $query=mysqli_query($db,$qrystring);
  //check how many rows does the query returned
  // (0=no match,1 means have match)
  if(mysqli_num_rows($query)>0){
	return true;	
  }
  else{
	return false;	
  }	
  mysqli_close($db);

}

function save_doctor(){
//include connection.php
include "connection.php";	

//fetch the data from the POST (array)
$rowdata=$_POST['data'];
$name=$rowdata[0]; //fetch index 0
$special=$rowdata[1];//fetch index 1
$gender=$rowdata[2];//fetch index 2
$religion=$rowdata[3];//fetch index 3
$nationality=$rowdata[4];//fetch index 4
$image=$rowdata[5]; //fetch index 5

//create a query
$query="INSERT INTO tbldoctors(doctorname,specialty,gender,religion, nationality,image) VALUES ('$name','$special','$gender','$religion','$nationality','$image')";
//execute the query	
  if(mysqli_query($db,$query)){
	echo "New doctor added!";	
  }
  else{
	echo mysqli_error($db);  
  }
}
?>
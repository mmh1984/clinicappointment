<?php
$operation=$_POST['operation'];
switch($operation){ //start of select
	case "saveservice":
	 if(service_exists()==false){
	   save_service();
	 }
	 else{
	   echo "Error, this service already exists";	 
	 }	
	break;	
	
	case "viewservices":
	 service_list();//function
	break;
	
	
	case "serviceselected":
	 service_selected();
	break;
	
	case "deleteservice":
	 delete_service();
	break;
	
	case "updateservice":
	update_service();
	break;
	
}//end of select

function update_service(){
  include 'connection.php';
  $id=$_POST['id'];
  $data=$_POST["rows"];
  $query=mysqli_query($db,"UPDATE tblservices SET
  servicename='$data[0]',servicetype='$data[1]',
  serviceprice=$data[2] 
  WHERE serviceid=$id");
  
  if($query){
	echo "Update successfull";  
  }
  else{
	echo die(mysqli_error($db));  
  }
	
}//end of function

function delete_service(){	
  include 'connection.php';
  $id=$_POST['sid'];
  $query=mysqli_query($db,"DELETE FROM
  tblservices WHERE serviceid=$id");
  
	if(!$query){
		echo "Error ". mysqli_error($db);	
	}
	else{
		echo "Success";
	}
}//end of function


function service_selected(){
include 'connection.php';
$id=$_POST["serviceid"];	
$query=mysqli_query($db,"SELECT * FROM 
tblservices WHERE serviceid=$id");

$result[]=array();//array of row
while($row=mysqli_fetch_array($query)){
  $result[0]["name"]=$row[1];
  $result[0]["type"]=$row[2];
  $result[0]["price"]=$row[3];		
}
echo json_encode($result);
}//end of function



function service_list(){
include "connection.php";
$query=mysqli_query($db,"SELECT * FROM tblservices");
//create the div,table and header tables
echo "<div class='well'>
      <h2>List of Services</h2>
	  <button class='btn btn-default pull-right' onclick='window.location.href=\"addservices.php\"'>+</button>
     <table class='table table-responsive table-striped'>
	 <tr>
	   <th>Service Name</th>
	   <th>Service Type</th>
	   <th>Service Price</th>
	   <th>Option</th>
	 </tr>";
while($row=mysqli_fetch_array($query)){
	echo "<tr>
	      <td>$row[1]</td>
		  <td>$row[2]</td>
		  <td>$row[3]</td>
		  <td><button onclick='edit_service($row[0])'>Edit</button></td>
		 </tr>";
}
//close the table and the div
echo "</table></div>";
mysqli_close($db);
}//end of function

function service_exists(){
  //include connection.php
  include "connection.php";
  $rowdata=$_POST['data'];
  $servicename=$rowdata[1];
  
  //create a query that will check if username is taken
  $qrystring="SELECT * FROM tblservices 
  WHERE servicename='$servicename'"; 
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

function save_service(){
//include connection.php
include "connection.php";	

//fetch the data from the POST (array)
$rowdata=$_POST['data'];
$sname=$rowdata[0]; //fetch index 0
$stype=$rowdata[1];//fetch index 1
$sprice=$rowdata[2];//fetch index 2

//create a query
$query="INSERT INTO tblservices(servicename,servicetype,serviceprice)
 VALUES('$sname','$stype',$sprice)";
//execute the query	
  if(mysqli_query($db,$query)){
	echo "Service successfully added";	
  }
  else{
	echo mysqli_error($db);  
  }
}
?>
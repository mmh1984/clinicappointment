<?php
$operation=$_POST['operation'];
switch($operation){ //start of select
	case "savemedicine":
	 if(medicine_exists()==false){
	   save_medicine();
	 }
	 else{
	   echo "Error,This medicine is already added to the system";	 
	 }	
	break;	

	case "viewmedicines":
	medicine_list();
	break;
	
	
	case "medicineselected":
	medicine_selected();
	break;
	
	case "deletemedicine":
	delete_medicine();
	break;
	
	case "updatemedicine":
	update_medicine();
	break;
	
	
	
		
}//end of select
function delete_medicine(){
 include 'connection.php';
  $id=$_POST['mid'];
  $query=mysqli_query($db,"DELETE FROM
  tblmedicine WHERE medicineid=$id");
  
	if(!$query){
		echo "Error ". mysqli_error($db);	
	}
	else{
		echo "Success";
	}
	
}
function update_medicine(){
  include 'connection.php';
  $id=$_POST['mid'];
  $data=$_POST["data"];
  $query=mysqli_query($db,"UPDATE tblmedicine SET
  medicinename='$data[0]',medicineusage='$data[1]',
  medicinedosage='$data[2]',medicinedescription= '$data[3]',medicinedetails= '$data[4]'
  WHERE medicineid=$id");
  
  if($query){
	echo "Update successfull";  
  }
  else{
	echo die(mysqli_error($db));  
  }
	
}//end of function

function medicine_selected(){
include 'connection.php';
$id=$_POST["medicineid"];	
$query=mysqli_query($db,"SELECT * FROM 
tblmedicine WHERE medicineid=$id");

$result[]=array();//array of row
while($row=mysqli_fetch_array($query)){
  $result[0]["name"]=$row[1];
  $result[0]["usage"]=$row[2];
  $result[0]["dosage"]=$row[3];	
  $result[0]["description"]=$row[4];	
  $result[0]["details"]=$row[5];
}
echo json_encode($result);
}//end of function

//function that will load table of doctors
function medicine_list(){
include "connection.php";
$query=mysqli_query($db,"SELECT * FROM tblmedicine");
//create the div,table and header tables
echo "<div class='well'>
      <h2>List of medicines</h2>
	  <button class='btn btn-default pull-right' onclick='window.location.href=\"addmedicine.php\"'>+</button>
     <table class='table table-responsive table-striped'>
	 <tr>
	   <th>Name</th>
	   <th>Usage</th>
	   <th>Dosage</th>
	   <th>Description</th>
	   <th>Details</th>
	   <th>Option</th>
	 </tr>";
while($row=mysqli_fetch_array($query)){
	echo "<tr>
	      <td>$row[1]</td>
		   <td>$row[2]</td>
		    <td>$row[3]</td>
			 <td>$row[4]</td>
		    <td>$row[5]</td>
			<td><button onclick='edit_medicine($row[0])'>Edit</button></td>
		 </tr>";
}
//close the table and the div
echo "</table></div>";
mysqli_close($db);
}//end of function


function medicine_exists(){
  //include connection.php
  include "connection.php";
  $rowdata=$_POST['data'];
  $name=$rowdata[0];
  
  //create a query that will check if username is taken
  $qrystring="SELECT * FROM tblmedicine 
  WHERE medicinename='$name'"; 
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

function save_medicine(){
//include connection.php
include "connection.php";	

//fetch the data from the POST (array)
$row=$_POST['data'];

//create a query
$query="INSERT INTO `tblmedicine`(`medicinename`, `medicineusage`, `medicinedosage`, `medicinedescription`, `medicinedetails`) VALUES ('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]')";
//execute the query	
  if(mysqli_query($db,$query)){
	echo "New medicine added!";	
  }
  else{
	echo mysqli_error($db);  
  }
}
?>
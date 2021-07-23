<?php
/*session check
in this section we will check for session. a session is a variable that holds the information from the webserver.we can use it to pass user login variables
*/
session_start(); //start session before using it
if(!isset($_SESSION["client"])){
//restrict access to this page
echo "<script>alert('You cannot access this page')</script>";
echo "<script>window.location.href='login.php'</script>";	
}


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Client Dashboard</title>
<script src='script/jquery.min.js' type='text/javascript'></script>
<script src='script/bootstrap.min.js' type='text/javascript'></script>
<script src='script/bootstrap-datetimepicker.js' type='text/javascript'></script>
<script src='script/bootstrap-datetimepicker.min.js' type='text/javascript'></script>
<link href='css/bootstrap.min.css' rel='stylesheet' type='text/css'/>
<link href='css/custom.css' rel='stylesheet' type='text/css'/>

</head>

<body>
<!--start of navbar-->
<div class='container-fluid navbar'>
  <div clas='row'>
    <div class='col-md-2'><h5 class='text-info'>Logged in as : <?php 
	echo $_SESSION["client"];
	?></h5></div>
    <div class='col-md-8'>
      <h1 class='text-primary text-center'>Borneo Clinic<small> Appointment System</small></h1>
    </div>
    <div class='col-md-2'>
      <div class="btn-group">
        <button type="button" class="btn btn-primary">Profile</button>
        <button type="button" class="btn btn-primary" data-toggle='modal' data-target='#logoutModal'>Logout</button>
      </div>
    </div>
  </div>
</div>
<!--end of nav bar-->

<div class='container-fluid'><!--registration form--> 
  
  <!--panel for login form-->
  <div class='col-md-4'>
  <!--left manu-->
    <div class='panel panel-default'>
      <div class='panel panel-heading'>Menu</div>
      <div class='panel-body'>
        <div>
         <ul class="list-group" id="usermenu">
  <li class="list-group-item" onClick="book_appointment()"><img src='images/appointmenticon.png' class='menuicon'/>&nbsp;Book an Appointment</li>
 
   <li class="list-group-item"><img src='images/clientsicon.png' class='menuicon'>&nbsp;History</li>
    <li class="list-group-item" onClick="load_appointment()"><img src='images/medicineicon.png' class='menuicon' >&nbsp;My Appointments</li>
    

        </div>
      </div>
      
    </div><!--end of panel-->
    
  </div><!--end of menu-->
  <div class='col-md-8'> 
  <!--content-->
  <div id='contents'>
  
  </div>
  <!--end of content-->
  
  
  </div>
</div>
<!--end registration form-->
<footer>
  <div class='container'> 
    <!--this is where the footer is--> 
  </div>
</footer>
</body>
</html>

<div id="logoutModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Logout</h4>
      </div>
      <div class="modal-body">
        <h3>Are your sure you want to logout?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" 
        onClick="logout_user()">Confirm</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>

<script>
function logout_user(){
	
	$.ajax({
		type:"POST",
		url:"phpfunctions/logout.php",
		
		success:function(msg){
			alert(msg);
			window.location.href='login.php';
		}
		
	});	
}

function book_appointment(){
	$("#contents").load("assets/addappointment.html");
	
}

function save_appointment(){
	if($("#appdate").val()==''){
		$("#appdate").after("<span class='text-warning'>Select booking date</span>");
	}
	else if($("#description").val()==''){
		$("#description").after("<span class='text-warning'>Enter description</span>");
	}
	else{
		$("#description").next("span").remove();
		$("#appdate").next("span").remove();
		
		contents=[];
		contents.push($("#appdate").val()); //row 0
		contents.push($("#branch").val()); //row 1
		contents.push($("#apptime").val()); //row 2
		contents.push($("#description").val()); //row 3
		
		$.ajax({
			type:"POST",
			url:"phpfunctions/bookings.php",
			data:{
				operation:"savebooking",
				data:contents	
			},
			success:function(msg){
				alert(msg)
				if(msg=='successful'){
					alert("booking complete");
					//load_bookings();	
				}	
				else{
					alert(msg);	
				}
			}	
			
			
		});
	}
}

//11-7-2018
function load_appointment(){
	$.ajax({
		type:"POST",
		url:"phpfunctions/bookings.php",
		data:{
		  operation:"loadbooking"	
		},
		success:function(msg){
			alert(msg);
		  $("#contents").html(msg)	
		}	
	});
}
</script>

<?php
//this code is to check if the session exists[logged user]
//1)start the session
session_start();
//2)check if the session for the user exists
if(!isset($_SESSION["admin"])){ //if admin is not logged on
	/*if the session doesnt exists, we will display a message and redirect the user to the login page
	*/
	echo "<script>
		alert('Error!, you dont have access to this page!');
		window.location.href='login.php';
	</script>";
}//end of if
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Services</title>
<link href='css/bootstrap.min.css' rel='stylesheet' type='text/css'/>
<link href='css/custom.css' rel='stylesheet' type='text/css'/>
<script src='script/bootstrap.min.js' type='text/javascript'></script>
</head>

<body>
<!--start of navbar-->
<div class='container-fluid navbar'>
  <div clas='row'>
    <div class='col-md-1'></div>
    <div class='col-md-6'>
      <h1 class='text-primary text-center'>Borneo Clinic<small> Appointment System</small></h1>
    </div>
  </div>
</div>
<!--end of nav bar-->

<div class='container'><!--registration form--> 
  
  <!--panel for login form-->
  <div class='row'>
    <div class='col-md-3'></div>
    <div class='col-md-6'> 
      <!--panel for login-->
      <div class='panel panel-primary'>
      	<div class='panel panel-heading'>
         <h1>Add New Services</h1>
        </div>
        <div class='panel panel-body'>
        <table class='table table-responsive'>
            <tr>
              <th scope="row">Service Name:</th>
              <td><input type='text' id='servicename' class='form-control'/></td>
            </tr>
            <tr>
              <th scope="row">Service Type:</th>
              <td>
                 <select id='servicetype' class='form-control'>
                    <option value='Out-Patient'>Out-Patient</option>
                    <option value='Checkup'>Checkup</option>
                    <option value='Surgery'>Surgery</option>
                    <option value='Permit'>Permit</option>
              	 </select>
              </td>
            </tr>
            <tr>
              <th scope="row">Price:</th>
              <td><input type='number' id='price' class='form-control'/></td>
            </tr>
          </table>
        </div>
        <div class='panel panel-footer'>
         <button class='btn btn-primary' id='btnsave'>Save</button>
         <button class='btn btn-default' id='btnback'>Back</button>
        
        </div>
      </div>
      <!--end of panel--> 
    </div>
    <div class='col-md-3'></div>
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
<script src='script/jquery.min.js' type='text/javascript'></script>
<script>
$(document).ready(function(e) {
    //if btnregister if clicked
	$("#btnback").click(function(e) {
        //redirect the page to register.php
		window.location.href='userdashboard.php';
    });
	//if btnlogin is clicked
	$("#btnsave").click(function(e) {
        //check if every input is complete
		if($("#servicename").val()==''){//username
			$("#servicename").after("<span class='text-warning'>Enter service name</span>");
		}
		else if($("#price").val()==''){//password
			$("#price").after("<span class='text-warning'>Enter the price</span>");
		}
		else{
			clear_span();
			save_service();
		}
		
    });
	
	
});//end of document.ready

//functions

function clear_span(){
  $("#servicename").next("span").remove();
  $("#price").next("span").remove();
}

function save_service(){
	//put all contents to array
	var contents=[]; //array
	contents.push($("#servicename").val()); //index 0
	contents.push($("#servicetype").val()); //index 1
	contents.push($("#price").val()); //index 2
	$.ajax({
		type:"POST",
		url:"phpfunctions/services.php",
		data:{
			operation:"saveservice",
			data:contents
		},
		success:function(msg){
			alert(msg);	
		}	
		
	});
	
}
</script>
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
<title>User Dashboard</title>
<script src='script/jquery.min.js' type='text/javascript'></script>
<script src='script/bootstrap.min.js' type='text/javascript'></script>
<link href='css/bootstrap.min.css' rel='stylesheet' type='text/css'/>
<link href='css/custom.css' rel='stylesheet' type='text/css'/>

</head>

<body>
<!--start of navbar-->
<div class='container-fluid navbar'>
  <div clas='row'>
    <div class='col-md-2'></div>
    <div class='col-md-8'>
      <h1 class='text-primary text-center'>Borneo Clinic<small> Appointment System</small></h1>
    </div>
    <div class='col-md-2'>
      <div class="btn-group">
        <button type="button" class="btn btn-primary">Profile</button>
        <button type="button" class="btn btn-primary">Logout</button>
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
  <li class="list-group-item"><img src='images/appointmenticon.png' class='menuicon'/>&nbsp;Appointments</li>
  <li class="list-group-item" onClick="load_service()"><img src='images/servicesicon.png' class='menuicon'>&nbsp;Services</li>
   <li class="list-group-item"><img src='images/clientsicon.png' class='menuicon'>&nbsp;Clients</li>
    <li class="list-group-item" onClick="load_medicine()"><img src='images/medicineicon.png' class='menuicon' >&nbsp;Medicine</li>
     <li class="list-group-item" onClick="load_doctors()"><img src='images/doctoricon.png' class='menuicon'>&nbsp;Doctors</li>
     <li class="list-group-item" onClick="load_events()"><img src='images/appointmenticon.png' class='menuicon'/>&nbsp;Events</li>
</ul>

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



<script src='script/photoupload.js' type='text/javascript'></script>
<script>
$(document).ready(function(e) {
  
  
	
});//end of document.ready

//functions
//function to load all services
function load_service(){
	//this function will only load the services from service table
	
	$.ajax({
	    type:"POST",
		url:"phpfunctions/services.php",
		data:{
			operation:"viewservices"
				
		},
		success:function(msg){
			
			$("#contents").html(msg);
		}	
	});
}//end of load_service
//function to load all doctors

function edit_service(id){
    $("#contents").load("assets/serviceform.html");
	$.ajax({
	    type:"POST",
		url:"phpfunctions/services.php",
		data:{
			operation:"serviceselected",
			serviceid:id
				
		},
		success:function(msg){
			
			var rows=$.parseJSON(msg)
			$("#sid").html(id);
			$("#servicename").val(rows[0].name);
			$("#servicetype").val(rows[0].type);
			$("#price").val(rows[0].price);
		}	
	});	
	
	
}

function del_service(){
	$.ajax({
		type:"POST",
		url:"phpfunctions/services.php",
		data:{
			operation:"deleteservice",
			sid:$("#sid").html()	
		},
		success:function(msg){
			alert(msg);//delete message
			load_service()//refresh the service list
		}	
	});
	
}

function update_service(){
//validate the inputs
if($("#servicename").val()==''){
  $("#servicename").after("<span>Enter service name</span>");
}	
else if($("#price").val()==''){
$("#price").after("<span>Enter price</span>");	
}
else{
$("#servicename").next("span").remove();
$("#price").next("span").remove();	

var contents=[];
contents.push($("#servicename").val()); //0
contents.push($("#servicetype").val()); //1
contents.push($("#price").val()); //2
$.ajax({ 
   type:"POST",	
   url:"phpfunctions/services.php",
   data:{
	 operation:"updateservice",
	 rows:contents,
	 id:$("#sid").html()
   },
   success:function(msg){
	alert(msg);   
	load_service();
   }});
}//end of else
	
}//end of function 


//doctors functions
function load_doctors(){
	//this function will only load the doctors from doctors table
	
	$.ajax({
	    type:"POST",
		url:"phpfunctions/doctors.php",
		data:{
			operation:"viewdoctors"
				
		},
		success:function(msg){
			
			$("#contents").html(msg);
		}	
	});
}//end of load_doctors


function edit_doctor(id){
	
    $("#contents").load("assets/doctorform.html");
	$.ajax({
	    type:"POST",
		url:"phpfunctions/doctors.php",
		data:{
			operation:"doctorselected",
			doctorid:id
				
		},
		success:function(msg){
			
			var rows=$.parseJSON(msg)
			$("#did").html(id);
			$("#doctorname").val(rows[0].name);
			$("#specialty").val(rows[0].special);
			$("#gender").val(rows[0].gender);
			$("#religion").val(rows[0].religion);
			$("#nationality").val(rows[0].nationality);
			$("#avatar").attr('src',rows[0].image);
		}	
	});	
	
	
}

function update_doctor(){
//validate the inputs
if($("#doctorname").val()==''){
  $("#doctorname").after("<span>Enter doctor name</span>");
}	
else{
$("#doctorname").next("span").remove();
	

var contents=[];
contents.push($("#doctorname").val()); //0
contents.push($("#specialty").val()); //1
contents.push($("#gender").val()); //2
contents.push($("#religion").val()); //3
contents.push($("#nationality").val()); //4
contents.push($("#avatar").attr("src")); //5
$.ajax({ 
   type:"POST",	
   url:"phpfunctions/doctors.php",
   data:{
	 operation:"updatedoctor",
	 rows:contents,
	 id:$("#did").html()
   },
   success:function(msg){
	alert(msg);   
	load_doctors();
   }});
}//end of else
	
}//end of function 
function del_doctor(){
	$.ajax({
		type:"POST",
		url:"phpfunctions/doctors.php",
		data:{
			operation:"deletedoctor",
			did:$("#did").html()	
		},
		success:function(msg){
			alert(msg);//delete message
			load_doctors()//refresh the service list
		}	
	});
	
}

//medicine functions
function load_medicine(){
	//this function will only load the doctors from doctors table
	
	$.ajax({
	    type:"POST",
		url:"phpfunctions/medicines.php",
		data:{
			operation:"viewmedicines"
				
		},
		success:function(msg){
			
			$("#contents").html(msg);
		}	
	});
}//end of load_doctors
function edit_medicine(id){
  $("#contents").load("assets/medicineform.html");
	$.ajax({
	    type:"POST",
		url:"phpfunctions/medicines.php",
		data:{
			operation:"medicineselected",
			medicineid:id
				
		},
		success:function(msg){
			
			var rows=$.parseJSON(msg)
		
			$("#mid").html(id);
			$("#medicinename").val(rows[0].name);
			$("#usage").val(rows[0].usage);
			$("#dosage").val(rows[0].dosage);
			$("#description").val(rows[0].description);
			$("#details").val(rows[0].details);
		
		
		}	
	});	
	
}

function del_medicine(){
	$.ajax({
		type:"POST",
		url:"phpfunctions/medicines.php",
		data:{
			operation:"deletemedicine",
			mid:$("#mid").html()	
		},
		success:function(msg){
			alert(msg);//delete message
			load_medicine()()//refresh the service list
		}	
	});
	
}

function load_events(){
	//this function will only load the doctors from doctors table
	
	$.ajax({
	    type:"POST",
		url:"phpfunctions/events.php",
		data:{
			operation:"viewevents"
				
		},
		success:function(msg){
			
			$("#contents").html(msg);
		}	
	});
}//end of load_doctors

function view_event(id){
	$.ajax({
		type:"POST",
		url:"phpfunctions/events.php",
		data:{
			operation:"eventdetails",
			id:id	
			
		},	
		success:function(msg){
			$("#contents").html(msg);
		}
	});
}

function add_photos(id){

	$("#contents").load("assets/addphoto.html",function(){
	$("#pid").html(id);	
		
	});

	
}


</script>
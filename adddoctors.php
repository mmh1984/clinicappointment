<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Doctors</title>
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
         <h1>Add Doctors</h1>
        </div>
        <div class='panel panel-body'>
        <div class='well center-block' style='text-align:center;width:300px'>
        <!--add this file for file upload and preview-->
          <img src='images/avatar.png' id='avatar' class='img-responsive center-block'>
            <input type="file" name="fileToUpload" id="filetoupload" onChange="show_image(this,'doctors')" accept="image/*" >
           
   <!--end of file upload avatar-->
        </div>
        <table class='table table-responsive'>
            <tr>
              <th scope="row">Doctor Name:</th>
              <td><input type='text' id='doctorname' class='form-control'/></td>
            </tr>
            <tr>
              <th scope="row">Specialty:</th>
              <td>
                 <select id='specialty' class='form-control'>
                    <option value='Dental'>Dental</option>
                    <option value='Orthopedic'>Orthopedic</option>
                    <option value='General Medicine'>General Medicine</option>
                    <option value='Pediatric'>Pediatric</option>
              	 </select>
              </td>
            </tr>
             <tr>
              <th scope="row">Gender:</th>
              <td>
                 <select id='gender' class='form-control'>
                    <option value='Male'>Male</option>
                    <option value='Female'>Female</option>
                  
              	 </select>
              </td>
            </tr>
            <th scope="row">Religion:</th>
              <td>
                 <select id='religion' class='form-control'>
                    <option value='Islam'>Islam</option>
                    <option value='Catholic'>Catholic</option>
                    <option value='Buddhism'>Buddhism</option>
                    <option value='Others'>Others</option>
              	 </select>
              </td>
            </tr>
            
             <th scope="row">Nationality:</th>
              <td>
                 <select id='nationality' class='form-control'>
                    <option value='Malaysia'>Malaysia</option>
                    <option value='Brunei'>Brunei</option>
                    <option value='Philippine'>Philippine</option>
                    <option value='China'>China</option>
                     <option value='Thailand'>Thailand</option>
                    <option value='Others'>Others</option>
              	 </select>
              </td>
            </tr>
           
          </table>
        </div>
        <div class='panel panel-footer'>
         <button class='btn btn-primary' id='btnadd'>Add</button>
         <button class='btn btn-default' id='btncancel'>Cancel</button>
        
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
<script src='script/photoupload.js' type='text/javascript'></script>
<script>
$(document).ready(function(e) {
    //if btnregister if clicked
	$("#btncancel").click(function(e) {
        //redirect the page to register.php
		window.location.href='userdashboard.php';
    });
	//if btnlogin is clicked
	$("#btnadd").click(function(e) {
        //check if every input is complete
		if($("#doctorname").val()==''){//username
			$("#doctorname").after("<span class='text-warning'>Enter doctor's name</span>");
		}
		
		else{
			clear_span();
			save_doctor();
		}
		
    });
	
	
});//end of document.ready

//functions

function clear_span(){
  $("#doctorname").next("span").remove();
 
}

function save_doctor(){
	//put all contents to array
	var contents=[]; //array
	contents.push($("#doctorname").val()); //index 0
	contents.push($("#specialty").val()); //index 1
	contents.push($("#gender").val()); //index 2
	contents.push($("#religion").val()); //index 3
	contents.push($("#nationality").val()); //index 4
	contents.push($("#avatar").attr("src")); //index 5
	$.ajax({
		type:"POST",
		url:"phpfunctions/doctors.php",
		data:{
			operation:"savedoctor",
			data:contents
		},
		success:function(msg){
			alert(msg);	
			window.location.href='userdashboard.php';
		}	
		
	});
	
}
</script>
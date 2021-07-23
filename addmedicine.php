<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Medicine</title>
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
         <h1>Add New Medicine</h1>
        </div>
        <div class='panel panel-body'>
        <table class='table table-responsive'>
            <tr>
              <th scope="row">Medicine Name:</th>
              <td><input type='text' id='medicinename' class='form-control'/></td>
            </tr>
           
           <tr>
              <th scope="row">Usage:</th>
              <td><input type='text' id='usage' class='form-control'/></td>
            </tr>
            
             <tr>
              <th scope="row">Dosage:</th>
              <td><input type='text' id='dosage' class='form-control'/></td>
            </tr>
            
             <tr>
              <th scope="row">Description:</th>
              <td><input type='text' id='description' class='form-control'/></td>
            </tr>
            
             <tr>
              <th scope="row">Details:</th>
              <td><input type='text' id='details' class='form-control'/></td>
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
		if($("#medicinename").val()==''){//username
			$("#medicinename").after("<span class='text-warning'>Enter medicine name</span>");
		}
		else if($("#usage").val()==''){//password
			$("#usage").after("<span class='text-warning'>Usage is required</span>");
		}
		else if($("#dosage").val()==''){//password
			$("#dosage").after("<span class='text-warning'>Dosage is required</span>");
		}
		else if($("#description").val()==''){//password
			$("#description").after("<span class='text-warning'>Description is required</span>");
		}
		else if($("#details").val()==''){//password
			$("#details").after("<span class='text-warning'>Details is required</span>");
		}
		else{
			clear_span();
			save_medicine();
		}
		
    });
	
	
});//end of document.ready

//functions

function clear_span(){
  $("#medicinename").next("span").remove();
  $("#usage").next("span").remove();
  $("#dosage").next("span").remove();
  $("#description").next("span").remove();
  $("#details").next("span").remove();
}

function save_medicine(){
	//put all contents to array
	var contents=[]; //array
	contents.push($("#medicinename").val()); //index 0
	contents.push($("#usage").val()); //index 1
	contents.push($("#dosage").val()); //index 2
	contents.push($("#description").val()); //index 1
	contents.push($("#details").val()); //index 2
	$.ajax({
		type:"POST",
		url:"phpfunctions/medicines.php",
		data:{
			operation:"savemedicine",
			data:contents
		},
		success:function(msg){
			alert(msg);	
		}	
		
	});
	
}


</script>
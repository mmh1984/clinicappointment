<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
<link href='css/bootstrap.min.css' rel='stylesheet' type='text/css'/>
<link href='css/custom.css' rel='stylesheet' type='text/css'/>
<script src='script/bootstrap.min.js' type='text/javascript'></script>

</head>

<body>
<!--start of navbar-->
<div class='container-fluid navbar'>
<div clas='row'>
	<div class='col-md-1'></div>
    <div class='col-md-6'><h1 class='text-primary text-center'>Borneo Clinic<small> Appointment System</small></h1></div>
</div>
</div>
<!--end of nav bar-->

<div class='container'><!--registration form-->

<!--panel for reg form-->
<div class='panel panel-primary'>
<div class='panel-heading'>Registration Form</div>
<div class='panel-body'>
<!--table for registration-->
<table class='table table-responsive table-striped'>
  <tr>
    <th scope="row">Full Name:</th>
    <td><input type='text' id='fname' class='form-control'/></td>
  </tr>
  <tr>
    <th scope="row">Phone Number:</th>
    <td><input type='text' id='phone' class='form-control'/></td>
  </tr>
  <tr>
    <th scope="row">Address:</th>
    <td>
    <textarea id='address' col='50' rows="5" class='form-control'></textarea>
    </td>
  </tr>
  <tr>
    <th scope="row">Email:</th>
    <td><input type='email' id='email' class='form-control'/></td>
  </tr>
  <tr>
    <th scope="row">Username:</th>
    <td><input type='text' id='username' class='form-control'/></td>
  </tr>
   <tr>
    <th scope="row">Password:</th>
    <td><input type='password' id='userpass' class='form-control'/></td>
  </tr>
   <tr>
    <th scope="row">Confirm Password:</th>
    <td><input type='text' id='confirmpass' class='form-control'/></td>
  </tr>
   <tr>
    <th scope="row"></th>
    <td><input type='checkbox' id='agree'/>I hereby agree that....</td>
  </tr>
</table>

<!--end of registration table-->
</div>
<div class='panel-footer'>
<!--buttons for registration-->
<button class='btn btn-primary' id='btnregister'>Register</button>
<button class='btn btn-default' onClick="window.location.href='login.php'">Back</button>
</div>
<!--end of panel-->
</div>

</div><!--end registration form-->
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
	

	$("#btnregister").click(function(e) {
        //check if every input is complete
		if($("#fname").val()==''){//fullname
			$("#fname").after("<span class='text-warning'>Enter your fullname</span>");
		}
		else if($("#phone").val()==''){//phone
			$("#phone").after("<span class='text-warning'>Enter your phone number</span>");
		}
		else if($("#address").val()==''){//address
			$("#address").after("<span class='text-warning'>Enter your address</span>");
		}
		else if($("#email").val()==''){//email
			$("#email").after("<span class='text-warning'>Enter your email</span>");
		}
		else if($("#username").val()==''){//username
			$("#username").after("<span class='text-warning'>Enter your username</span>");
		}
		else if($("#userpass").val()==''){//password
			$("#userpass").after("<span class='text-warning'>Enter your password</span>");
		}
		//check if userpass and confirmpass is the same
		else if($("#userpass").val()!=$("#confirmpass").val()){//password
			$("#confirmpass").after("<span class='text-warning'>Passwords doesnt match</span>");
		}
		//check if checkbox agree is selected
		else if($("#agree").is(":checked")==false){
			alert("Please agree to terms");
		}
		//if all inputs are ok
		else{
			clear_span();
			register_user();
		}
		
    });
	
	
});//end of document.ready

//functions

function clear_span(){
  $("#fname").next("span").remove();
  $("#phone").next("span").remove();
  $("#address").next("span").remove();
  $("#email").next("span").remove();
  $("#username").next("span").remove();
  $("#userpass").next("span").remove();
  $("#confirmpass").next("span").remove();
	
}

function register_user(){
	//put all contents to array
	var contents=[]; //array
	contents.push($("#fname").val()); //index 0
	contents.push($("#phone").val()); //index 1
	contents.push($("#address").val()); //index 2
	contents.push($("#email").val()); //index 3
	contents.push($("#username").val()); //index 4
	contents.push($("#userpass").val()); //index 5
	
	$.ajax({
		type:"POST",
		url:"phpfunctions/users.php",
		data:{
			operation:"saveclient",
			data:contents
		},
		success:function(msg){
			alert(msg);	
			window.location.href='login.php';
		}	
		
	});
	
}
</script>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
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
    <div class='col-md-4'></div>
    <div class='col-md-4'> 
      <!--panel for login-->
      <div class='panel panel-primary'>
        <div class='panel panel-heading'>
          <h1>Member Login</h1>
        </div>
        <div class='panel panel-body'>
          <table class='table table-responsive'>
            <tr>
              <th scope="row">Username:</th>
              <td><input type='text' id='username' class='form-control'/></td>
            </tr>
            <tr>
              <th scope="row">Password:</th>
              <td><input type='password' id='password' class='form-control'/></td>
            </tr>
            
            <tr>
              <th scope="row">Login As:</th>
              <td>
              <select class='form-control'id='usertype'>
              	<option value='admin'>Admin</option>
                <option value='client' selected>Client</option>
              
               </select>
              </td>
            </tr>
          </table>
        </div>
        <div class='panel panel-footer'>
          <div class='center-block'>
            <button class='btn btn-primary' id='btnlogin' onClick="login_user()"> Login</button>
            <button class='btn btn-default' id='btnregister'> Register</button>
          </div>
        </div>
      </div>
      <!--end of panel--> 
    </div>
    <div class='col-md-4'></div>
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


function login_user(){
	
	if($("#username").val()==''){//username
		alert('Enter your username');
	}
	else if($("#password").val()==''){//password
		alert('Enter your password');
	}
	else{
	//put all contents to array
	var contents=[]; //array
	contents.push($("#username").val()); //index 0
	contents.push($("#password").val()); //index 1
	
	$.ajax({
		type:"POST",
		url:"phpfunctions/loginfunction.php",
		data:{
			operation:"login",
			data:contents,
			usertype:$("#usertype").val()
		},
		success:function(msg){
			if(msg=="admin"){
				alert("Login successful!");
				window.location.href='admindashboard.php';	
			}
			else if(msg=="client"){
				alert("Login successful!");
				window.location.href='userdashboard.php';	
			}
			else{
				alert(msg);
			}
		}	
		
	});
	
	}
}
</script>
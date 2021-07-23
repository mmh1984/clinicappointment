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
      
    </div>
  </div>
</div>
<!--end of nav bar-->

<div class='container-fluid'><!--registration form--> 
  
  <!--panel for login form-->
  <div class='col-md-4'>
  <!--left manu-->
    <div class='panel panel-default'>
      <div class='panel panel-heading'>Contact Details</div>
      <div class='panel-body'>
        <div>
         <table class='table table-condensed table-striped'>
           <tr>
         	  <th>Phone Number:</th>
              <td>+673</td>
            <tr>
            <tr>
         	  <th>Fax:</th>
              <td>+673</td>
            <tr>
            <tr>
         	  <th>Email:</th>
              <td>youremail@kemuda.com</td>
            <tr>
            <tr>
         	  <th>Address:</th>
              <td>+673</td>
            <tr>
            <tr>
         	  <th>Business Hours:</th>
              <td></td>
            <tr>
         </table>

        </div>
      </div>
      
    </div><!--end of panel-->
    
  </div><!--end of menu-->
  <div class='col-md-8'> 
  <!--content-->
  <div id='map' style='height:80vh;background:#CCC'>
  
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUYBvPSbcmNkU5cQnNFEe2T6AEnuUBYQk&callback=load_map"
  type="text/javascript"></script>
<script>
$(document).ready(function(e) {
    load_map();
});

function load_map() {
  var mapCanvas = document.getElementById("map"); //map is the name of the div
  var myCenter = new google.maps.LatLng(4.897692,114.894601); //lat,lang (google maps)
  var mapOptions = {center: myCenter, zoom: 15}; //zoom level
  var map = new google.maps.Map(mapCanvas,mapOptions);
  var marker = new google.maps.Marker({
    position: myCenter,
    animation: google.maps.Animation.BOUNCE
  });
  marker.setMap(map);
}
</script>

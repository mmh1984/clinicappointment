1) Paste upload.php inside "phpfunctions" folder
2) Paste photoupload.js inside "script" folder
3) Choose a page where you want to add a photo upload function (example add doctors.php)
4) Paste the code below (before the table of the first input)

 <div class='well center-block' style='text-align:center;width:300px'>
        <!--add this file for file upload and preview-->
          <img src='images/avatar.png' id='avatar' class='img-responsive center-block'>
            <input type="file" name="fileToUpload" id="filetoupload" onChange="show_image(this,'doctors')" accept="image/*" >
           
   <!--end of file upload avatar-->
        </div>

5) Add the code below at the bottom (where the <script></script> is)
<script src='script/photoupload.js' type='text/javascript'></script>

6) download any PNG photo and save it inside "images". Name the photo "avatar"

7) Create a folder inside "images" and name it "doctors"

8) Open save_doctor (adddoctors.php)	
after the LAST contents.push(), paste this code: 

contents.push($("#avatar").attr("src"));

9) Open doctors.php (inside phpfunctions). Go to save_doctor function.
	Add the code below after $nationality=$rowdata[4]
	$image=$rowdata[5]; //fetch index 5
   
	inside the $query, add the 'image' column and add '$image' on the 	values
10) Open doctor_list inside doctors.php and add another <th></th> before the name: (see code below)
    <th>image</th>

11) Inside the loop (mysqli_fetch_array) add another <td> above <td>$row[1]</td> (see code below)

	<td><img src='$row[6]' width='80px' class='img img-responsive'/></td>

12) Inside save_doctor function (js) in adddoctors.php, add the code below after the "alert":

	window.location.href='userdashboard.php'
      
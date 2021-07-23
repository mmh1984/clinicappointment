<?php

$operation=$_POST["operation"];

switch($operation){
   
   case "upload":
   upload_image();
   break;
   
   case "delete":
   delete_image();	
	break;
	
}
function delete_image(){

$file_to_delete=$_POST["src"];
if (unlink("../".$file_to_delete)>0){
 echo "File Deleted";	
	
}
else{
 echo "Error deleting file";	
}

	
}


function upload_image(){
$img=$_FILES["img"]["name"]; //get the filename of the img file
$folder=$_POST["folder"]; //location where the image will be saved

$file="../images/".$folder."/".basename($img); //file to be uploaded
echo $_FILES["img"]["size"]; //get the size of the file
if($_FILES["img"]["size"]>2000000){  //check if file is larger than 2mb
	echo "Error.image must be less than 2mb";
}

else if($_FILES["img"]["error"]!="01"){ //01 is error code for upload
//upload file if it is less than 2mb
move_uploaded_file($_FILES["img"]["tmp_name"],$file); //upload
$location='images/'.$folder.'/'.$img; //location of the uploaded file
echo $location; //echo the PATH	
	
}

else{ 
echo $_FILES["img"]["error"];
}

}//end of upload image;
?>
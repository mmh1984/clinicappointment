// JavaScript Document

function show_image(object,folder){

//show upload button right after the user selects an a file
$(object).after("<button class='btn btn-primary btn-sm' id='btnupload' onclick='upload_image(\""+folder+"\")'>Upload</button>");
//set the folder to upload to "doctors"
		alert(folder);
}
//upload the image
function upload_image(folder){

$("#avatar").next("button").remove(); //remove the "remove" button	

/*
form data are used to store ARRAYS of data to be submitted. 
formdata are used if the file(s) to be submitted consists of media files (image,video,file)

if the data to be submitted are pure text, an ARRAY (var=[]) can be used instead
*/
var formdata=new FormData(); //create a new form data
formdata.append("img",document.getElementById("filetoupload").files[0]); //index id="photo"
formdata.append("folder",folder); //index id="folder"
formdata.append("operation","upload"); //index id="operation"
$.ajax({
	url:"phpfunctions/upload.php",
	contentType: false, //no specific filetype
    cache: false, //do not cache the data
    processData: false, //no data processing required
	type:"POST", //type of data submit
	data:formdata, //data to be sent/processed
	success:function(msg){ //once the request is completed(successful)
		
		if(msg.search("images/")>0){ //if upload is successful (>0)
			alert("Upload complete"); //display an alert
			$("#filetoupload").next("button").remove(); //remove the "upload" button
			//set the image src of the avatar to the uploaded image 
			var path="images/" + folder + "/" +document.getElementById("filetoupload").files[0].name ;
			$("#avatar").attr("src",path);
			
			//add a "remove" button after the "avatar" with onclick=remove_image(folder)
			$("#avatar").after("<button class='btn btn-primary btn-sm' id='btnupload' onclick='remove_image(\""+ folder +"\")'>Remove</button>");
			
		}
		else{ //if upload contains errors
			alert("Error Uploading File"); //display an alert
				$("#filetoupload").next("button").remove(); //remove the "upload" button
				$("#filetoupload").val(""); //set the value of "photo" to empty
		}
		
	}
	
});	
	
}

function remove_image(folder){
   var src=$("#avatar").attr("src");
   $.ajax({
	  type:"POST",
	  url:"phpfunctions/upload.php",
	  data:{
		operation:"delete",
		src:src	  
	  } ,
	  success:function(msg){
		alert(msg);
		$("#avatar").attr("src","images/avatar.png");
		$("#avatar").next("button").remove();
		$("#filetoupload").val("");	  
	  }  
	   
   });



}
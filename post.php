<?php
session_start();
include_once("db.php");
if(isset($_POST['post'])){
	//$id = strip_tags($_POST['id']);
	$title = strip_tags($_POST['title']);
	$content = strip_tags($_POST['content']);

	
	//$id = mysqli_real_escape_string($db, $id);
	$title = mysqli_real_escape_string($db, $title);
	$content = mysqli_real_escape_string($db, $content);

	$date= date('l jS \of F Y h:i:s A');

	$sql="INSERT into posts (title, content, date) VALUES ('$title', '$content', '$date')";

if (($_FILES['my_file']['name']!="")){
	// if(!empty($_FILES) && isset($_FILES['image'])){
	// // Where the file is going to be stored
		
	$target_dir = "C:/wamp64/www/back/blog/images/";
	$file = $_FILES['my_file']['name'];
	$path = pathinfo($file);
	$filename = $path['filename'];
	$ext = $path['extension'];
	$temp_name = $_FILES['my_file']['tmp_name'];
	$path_filename_ext = $target_dir.$filename.".".$ext;
 
	// Check if file already exists
	if (file_exists($path_filename_ext)) {
 	echo "Sorry, file already exists.";
 	}else{
 	move_uploaded_file($temp_name,$path_filename_ext);
 	echo "Congratulations! File Uploaded Successfully.";
 }
}



	if($title =="" || $content == ""){
		echo "Please complete your post!";
		return;
	}
	mysqli_query($db, $sql);

	header("Location: index.php");

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog - Post</title>
</head>
<body>
  	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<style>
   .row.content {height: 1500px}
    
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    footer {
    	position: fixed;
      background-color: #000000;
     left: 0;
   	bottom: 0;
   	width:100%;
      color: white;
      padding: 15px;
    }
    .button {
  padding: 10px 25px;
  font-size: 15px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #FFFFFF;
  background-color: #D74646;
  border: none;
  border-radius: 7px;
  box-shadow: 0 7px #999;
}

.button:hover {background-color: #EC5A5A}

.button:active {
  background-color: #EC5A5A;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }

	.dropzone {
	width:1110px;
	height:300px;
    border: 2px dashed #ccc;
    text-align: center;
    line-height: 300px;
    color: #ccc;
    /*border-color:#000;*/
	}

    .dropzonedragover{
    	border: 2px dashed #000;
    	color:#000;
    
	}

	.dropOn{
		width:1110px;
		height:300px;
		border: 2px dashed #000;
    	color:#000;	
    	text-align: center;
    	line-height: 300px;
	}

  </style>

<div class="container">
      <br />
      <br />
     <div class="form-group">
        <form name="add_name" id="add_name" action="post.php" method="post" enctype="multipart/form.data">
          <div class="table-responsive">
            <h2>Title</h2>
            <input class="form-control" placeholder="Title" name="title" type="text" autofocus size="48"><br/>
            <table class="table table-bordered" id="dynamic_field">
              <tr>
                <h2>Leave a comment:</h2>
                <td><textarea class="form-control"  placeholder="Roast here!" name="content[]" rows="3" required></textarea>
                <br>
                <input type="file" name="my_file" />
                </td>
                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
              </tr>
              <!-- <tr><td><input type="file" name="my_file" />
              	</td></tr> -->
            </table>
            <input name="post" type="submit" id="submit" value="Post" class="button" />
           
          </div>
        </form>
      </div>
    </div>
  </body>
</html>

<script>
$(document).ready(function(){
  var i=1;
  $('#add').click(function(){
    i++;
    $('#dynamic_field').append('<tr id="row'+i+'"><td><textarea class="form-control"  placeholder="Roast here!" name="content[]" rows="3" required></textarea><input type="file" name="my_file" /></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
  });
  
  $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#row'+button_id+'').remove();
  });
  
  $('#submit').click(function(){    
    $.ajax({
      url:"post.php",
      method:"POST",
      data:$('#add_name').serialize(),
      success:function(data)
      {
        // alert(data);
        $('#add_name').reset();
      }
    });
  });
  
});
</script>
</body>
</html>
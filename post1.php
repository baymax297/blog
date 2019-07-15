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

	if($title =="" || $content == ""){
		echo "Please complete your post!";
		return;
	}
	mysqli_query($db, $sql);

	header("Location: post.php");

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

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h2>Search Blogs</h2>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#section1">Home</a></li>
        <li><a href="#section2">Friends</a></li>
        <li><a href="#section3">Family</a></li>
        <li><a href="#section3">Photos</a></li>
      </ul><br>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Blog...">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div>
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
                <td><textarea class="form-control"  placeholder="Roast here!" name="content" rows="3" required></textarea></td>
                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
              </tr>
            </table>
            <input name="post" type="submit" id="submit" value="Post" class="button">
           
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
    $('#dynamic_field').append('<tr id="row'+i+'"><td><textarea class="form-control"  placeholder="Roast here!" name="content" rows="3" required></textarea></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
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
        alert(data);
        $('#add_name')[0].reset();
      }
    });
  });
  
});
</script>
</body>
</html>
<!-- 
<div class="col-sm-9">
<form role="form-group" action="post.php" id="blog_form" method="post" enctype="multipart/form.data">
    <h2>Title</h2>
    <input class="form-control" placeholder="Title" name="title" type="text" autofocus size="48"><br/>
<table class="table table-bordered" id="dynamic field">
<tr>
    <td><h2>Leave a comment:</h2>
    <textarea class="form-control"  placeholder="Roast here!" name="content" rows="3" required></textarea><br/>
  </td>
</tr>
</table>

<div class ="container">
	<h2>Title</h2>
	<div class="panel-body">
<input class="form-control" placeholder="Title" name="title" type="text" autofocus size="48"><br/>
</div></div>
<div class ="container">
<h2>Leave a comment:</h2>
<div class="panel-body">
<textarea class="form-control"  placeholder="Roast here!" name="content" rows="3" required></textarea><br/>
<div id="uploads"></div>
<div class="dropzone" id="dropzone">Drag and Drop files here to upload!</div>
</div></div>
 -->
<!-- <br> -->
<!-- <br> -->
<!-- <div class ="container"> -->
<!-- <input name="add" id="add" type="button" value="Add Fields" class="button"> -->
<!-- <button name="add" id="add" type="button" class="button">Add Fields</button>
<input name="post" type="submit" id="submit" value="Post" class="button">
<br>
</div>
</form>
</div>
 --><!-- </div> -->
<!-- </div> -->
<!-- <footer class="container-fluid">
  <h4>Briyani and beer, if you like it!</h4>
</footer>
 --><!-- <script> -->
<!-- $(document).ready(function(){ -->
    <!-- var i=1 ;
    $('#add').click(function(){
      i++;
      $('dynamic_field').append('<tr id="row"'+i+'"><td><textarea class="form-control"  placeholder="Roast here!" name="content" rows="3" required></textarea></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button</td></tr>');
    });
    $(document).on('click','.btn_remove', function(){
      var button_id = $(this).attr("id");
      $("#row"+button_id+"").remove();
    });
    
    $('#submit').click(function(){
    $.ajax({
    url:"post.php", 
    method:"POST", 
    data:('#blog_form').serialize(),
    success:function(data){
      alert(data);
      $('#blog_form')[0].reset();
    }
    });
    });
}); -->
<!-- 
// <h2>Leave a comment:</h2>
	// (function(){
	// 	var dropzone =document.getElementById('dropzone');
	// 	dropzone.ondragover = function(){
	// 		// console.log('over on');
	// 		document.getElementById("dropzone").className = "dropOn";
	// 		return false;
	// 	}
	// 	dropzone.ondragleave=function(){
	// 		// console.log('over off');
	// 		document.getElementById("dropzone").className = "dropzone";
	// 		return false;
	// 	}
	// 	// console.log(this.className);
	// }());
</script> -->
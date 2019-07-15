<<?php  
$target_dir="uploads/";
	$target_file=$target . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk=1;
	$imageFileType=strtlower(pathinfo($target_file,PATHINFO_EXTENSION));
	$check=getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false){
		echo "File is an image -" . $check["mime"] . ".";
		$uploadOk = 1;
	}else{
		echo "File is not an image.";
		$uploadOk =0;
	}
	//check if file already exists
	if(file_exists($target_file)){
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
?>
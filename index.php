<?php
session_start();
include_once("db.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>


</head>
<body>
<?php
require_once("nbbc/nbbc.php");

$bbcode =new BBCode;

$sql= "SELECT * FROM posts ORDER BY id DESC";

$res = mysqli_query($db, $sql) or die(mysqli_error());

$posts = "";
if (mysqli_num_rows($res) > 0){
	while($row=mysqli_fetch_assoc($res)){
		$id = $row['id'];
		$title = $row['title'];
		$content = $row['content'];
		$date = $row['date'];

		$admin = "<div><a href='del_post.php?pid=$id'>Delete</a>&nbsp;<a href='edit_post.php?pid=$id'>Edit</a></div>";

		$output= $bbcode->Parse($content);

		$posts .= "<div><h3><small><a href='view_post.php?pid=$id'>$title</a></small></h3><p>$date</p><p>$output</p>$admin<hr/></div>";
	}
	echo $posts;
}else{
	echo "There are no posts to display!";
}
?>
&nbsp;
<a href='post.php' target='_blank'>Post</a>
</body>
</html>
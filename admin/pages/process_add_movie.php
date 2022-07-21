<?php
session_start();
include('../../config.php');
extract($_POST);
$target_dir = "../../images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$flname = "images/" . basename($_FILES["image"]["name"]);
mysqli_query($con, "INSERT INTO  tbl_movie VALUES(NULL,'$name','$cast','$desc','$rdate','$flname','$video','$length')");
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
echo $_FILES["image"]["tmp_name"];
$_SESSION['success'] = "Movie Added";
header('location:add_movie.php');

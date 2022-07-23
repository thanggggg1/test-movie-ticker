<?php
session_start();
include('../../config.php');
extract($_POST);
$mv = mysqli_query($con, "SELECT `image` FROM tbl_movie WHERE movie_id = '$id'");
$movie = mysqli_fetch_array($mv);
if (empty($_FILES["image"]["name"])) {
    $flname = $movie['image'];
} else {
    $target_dir = "../../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $flname = "images/" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    echo $_FILES["image"]["tmp_name"];
}
mysqli_query($con, "UPDATE tbl_movie set movie_name='$name',`cast`='$cast',`desc`='$desc',release_date='$rdate',`image`='$flname',video_url='$video',`length`='$length' WHERE movie_id = '$id'");
$_SESSION['success'] = "Movie Update Successfully!";
header('location:index.php');

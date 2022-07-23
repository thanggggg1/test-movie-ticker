<?php
session_start();
include('config.php');
extract($_POST);
$lg = mysqli_query($con, "SELECT username FROM tbl_login WHERE `user_id` ='" . $_SESSION['user'] . "'");
if ($email != mysqli_fetch_array($lg)['username']) {
    mysqli_query($con, "UPDATE tbl_login SET username = '$email' WHERE `user_id` ='" . $_SESSION['user'] . "' ");
}
mysqli_query($con, "update tbl_users set name= '$name',email = '$email',phone = '$phone',age = '$age',gender = '$gender' WHERE `user_id` ='" . $_SESSION['user'] . "' ");
$_SESSION['success'] = "Update successfully!";
header('location:profile.php');

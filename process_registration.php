<?php
session_start();
include('config.php');
extract($_POST);
$qry = mysqli_query($con, "SELECT * from tbl_login where username = '$email'");
if (mysqli_num_rows($qry)) {
    $_SESSION['error'] = 'Email already exist';
    header('location:registration.php');
} else {
    mysqli_query($con, "insert into  tbl_users values(NULL,'$name','$email','$phone','$age','$gender')");
    $id = mysqli_insert_id($con);
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($con, "insert into  tbl_login values(NULL,'$id','$email','$hashed_pass')");
    $_SESSION['user'] = $id;
    header('location:index.php');
}

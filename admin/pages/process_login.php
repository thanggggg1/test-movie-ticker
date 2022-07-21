<?php
include('../../config.php');
session_start();
$email = $_POST["Email"];
$pass = $_POST["Password"];
$qry = mysqli_query($con, "select * from tbl_login_admin where username='$email' and password='$pass'");
if (mysqli_num_rows($qry)) {
    $usr = mysqli_fetch_array($qry);
    if ($usr['user_type'] == 0) {
        $_SESSION['admin'] = 0;
        header('location:index.php');
    } else {
        $_SESSION['error'] = "Login Failed!";
        header("location:../index.php");
    }
} else {
    $_SESSION['error'] = "Login Failed!";
    header("location:../index.php");
}

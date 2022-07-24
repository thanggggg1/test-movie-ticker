<?php
include('config.php');
session_start();
$email = $_POST["Email"];
$pass = $_POST["Password"];
$qry = mysqli_query($con, "select * from tbl_login where username='$email'");
if (mysqli_num_rows($qry)) {
    $data = mysqli_fetch_array($qry);
    if (password_verify($pass, $data['password'])) {
        $_SESSION['user'] = $data['user_id'];
        if (isset($_SESSION['show'])) {
            header('location:booking.php');
        } else {
            header('location:index.php');
        }
    } else {
        $_SESSION['error'] = "Login Failed: Invalid Password!";
        header("location:login.php");
    }
} else {
    $_SESSION['error'] = "Login Failed: Invalid Email!";
    header("location:login.php");
}

<?php
session_start();
include('../../config.php');

$uid = $_GET['uid'];
mysqli_query($con, "delete from tbl_users where user_id='$uid'");
$_SESSION['success'] = "User deleted successfully";
header("location:view_users.php");

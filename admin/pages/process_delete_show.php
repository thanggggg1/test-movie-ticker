<?php
session_start();
include('../../config.php');

$sid = $_GET['sid'];
mysqli_query($con, "delete  from tbl_shows where s_id='$sid'");
$_SESSION['success'] = "Show deleted successfully";
header("location:view_shows.php");

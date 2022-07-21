<?php
session_start();
include('../../config.php');

$rid = $_GET['rid'];
mysqli_query($con, "delete  from tbl_rooms where room_id='$rid'");
$_SESSION['success'] = "Room deleted successfully";
header("location:view_rooms.php");

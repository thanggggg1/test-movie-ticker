<?php
session_start();
include('config.php');
mysqli_query($con, "delete from tbl_bookings where book_id='" . $_GET['id'] . "'");
mysqli_query($con, "delete from tmp_seats where s_id = '" . $_GET['s_id'] . "' AND book_id = '" . $_GET['id'] . "'");
$_SESSION['success'] = "Booking Cancelled Successfully";
header('location:profile.php');

<?php
session_start();
include('../../config.php');
$us = mysqli_query($con, "SELECT s_id FROM tbl_shows WHERE ((start_date < CURDATE())||((start_date = CURDATE())&&(end_time < CURRENT_TIME())))");
if (mysqli_num_rows($us)) {
    while ($update = mysqli_fetch_array($us)) {
        mysqli_query($con, "delete from tbl_shows where s_id='" . $update['s_id'] . "'");
    }
}
$_SESSION['success'] = "Show update successfully";
header("location:view_shows.php");

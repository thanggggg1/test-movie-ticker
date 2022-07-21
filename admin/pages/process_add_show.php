<?php
session_start();
include('../../config.php');
extract($_POST);
$qry1 = mysqli_query($con, "SELECT length from tbl_movie where movie_id='$movie'");
$length = mysqli_fetch_array($qry1)['length'];
$etime = date('H:i:s', strtotime($stime . "+" . $length . " minutes"));
$stime = date('H:i:s', strtotime($stime));
mysqli_query($con, "INSERT INTO tbl_shows VALUES(NULL,'$room','$movie','$sdate','$stime','$etime')");
$_SESSION['success'] = "Show Added";
header('location:view_shows.php?date=' . $sdate);

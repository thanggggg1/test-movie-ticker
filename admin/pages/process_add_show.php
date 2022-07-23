<?php
include('../../config.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
extract($_POST);
if ($sdate <= date('Y-m-d')) {
    $_SESSION['success'] = "Invalid date!";
    header('location:add_show.php');
} else {
    $qry0 = mysqli_query($con, "SELECT start_time,end_time FROM tbl_shows WHERE room_id ='$room' AND start_date = '$sdate'");
    $qry1 = mysqli_query($con, "SELECT length from tbl_movie where movie_id='$movie'");
    $length = mysqli_fetch_array($qry1)['length'];
    $etime = date('H:i:s', strtotime($stime . "+" . $length . " minutes"));
    $stime = date('H:i:s', strtotime($stime));
    $chk = true;
    if (!empty(mysqli_num_rows($qry0))) {
        while ($check = mysqli_fetch_array($qry0)) {
            if (($stime > $check['start_time'] && $stime < $check['end_time']) || ($etime > $check['start_time'] && $etime < $check['end_time'])) {
                $chk = false;
                break;
            }
        }
    }
    if (empty($chk)) {
        $_SESSION['success'] = "This show coincides with another show!";
        header('location:view_shows.php?date=' . $sdate);
    } else {
        mysqli_query($con, "INSERT INTO tbl_shows VALUES(NULL,'$room','$movie','$sdate','$stime','$etime')");
        $_SESSION['success'] = "Show Added";
        header('location:view_shows.php?date=' . $sdate);
    }
}

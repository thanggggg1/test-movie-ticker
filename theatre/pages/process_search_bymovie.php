<?php include('../../config.php');
session_start();
extract($_GET);
$today = date("Y-m-d");
$qry2 = mysqli_query($con, "select movie_id from tbl_movie where movie_name='" . $search . "'");
if (!mysqli_num_rows($qry2)) {
    $_SESSION['status'] = "error";
    header("location:view_shows.php");
} else {
    $mid = mysqli_fetch_array($qry2)['movie_id'];
    header("location:view_shows.php?mid=" . $mid);
}

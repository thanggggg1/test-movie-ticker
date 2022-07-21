<?php include('../../config.php');
session_start();
extract($_GET);
$qry2 = mysqli_query($con, "select user_id from tbl_registration where email='" . $search . "'");
if (!mysqli_num_rows($qry2)) {
    $_SESSION['status'] = "error";
    header("location:view_users.php");
} else {
    $uid = mysqli_fetch_array($qry2)['user_id'];
    header("location:view_users.php?uid=" . $uid);
}

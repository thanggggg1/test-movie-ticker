<?php include('../../config.php');
session_start();
extract($_GET);
$qry2 = mysqli_query($con, "select book_id from tbl_bookings where ticket_id='" . $search . "'");
if (!mysqli_num_rows($qry2)) {
    $_SESSION['status'] = "error";
    header("location:view_bookings.php");
} else {
    $bid = mysqli_fetch_array($qry2)['book_id'];
    header("location:view_bookings.php?bid=" . $bid);
}

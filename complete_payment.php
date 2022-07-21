<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
include('config.php');
session_start();
$m = mysqli_query($con, "select movie_name,movie_id from tbl_movie where movie_id='" . $_SESSION['movie'] . "'");
$mov = mysqli_fetch_array($m);
$st = mysqli_query($con, "select * from tbl_shows where s_id='" . $_SESSION['show'] . "'");
$stm = mysqli_fetch_array($st);
$s = mysqli_query($con, "select room_name from tbl_rooms where room_id ='" . $stm['room_id'] . "'");
$srn = mysqli_fetch_array($s);
$combo_id = null;
$combo_desc = null;
if (!empty($_SESSION['combo_id'])) {
    $cb = mysqli_query($con, "select * from tbl_combos where combo_id ='" . $_SESSION['combo_id'] . "'");
    $combo = mysqli_fetch_array($cb);
    $combo_id = $combo['combo_id'];
    $combo_desc = $combo['desc'];
}
$ticketid = "TIK";
mysqli_query($con, "INSERT into tbl_bookings values(NULL,'$ticketid','" . $_SESSION['user'] . "','" . $stm['start_time'] . "','" . $srn['room_name'] . "','" . $mov['movie_id'] . "','" . $mov['movie_name'] . "','" . $_SESSION['seats'] . "','" . $_SESSION['total_amount'] . "','" . $_SESSION['date'] . "',CURDATE(),NULL,NULL)");
$bid = mysqli_query($con, "SELECT book_id FROM tbl_bookings ORDER BY book_id desc LIMIT 1");
$bookid = mysqli_fetch_assoc($bid)['book_id'];
$ticketid = "TIK" . $bookid;
mysqli_query($con, "UPDATE tbl_bookings SET ticket_id = '$ticketid' WHERE book_id = '$bookid'");
if ($combo_id) {
    mysqli_query($con, "UPDATE tbl_bookings SET combo_id = '$combo_id',combo_desc='$combo_desc' WHERE book_id = '$bookid'");
}
$seats_booked = explode(" ", $_SESSION['seats']);
foreach ($seats_booked as $seat) {
    if ($seat) {
        $query = mysqli_query($con, "INSERT INTO tmp_seats VALUES('" . $_SESSION['show'] . "','$bookid','$seat')");
    }
}
$_SESSION['success'] = "Bookings Done!";
unset($_SESSION['show']);
unset($_SESSION['movie']);
unset($_SESSION['seatings']);
unset($_SESSION['amount']);
unset($_SESSION['date']);
unset($_SESSION['seats']);
unset($_SESSION['total_amount']);
?>

<table align='center'>
    <tr>
        <td><STRONG>Transaction is being processed,</STRONG></td>
    </tr>
    <tr>
        <td>
            <font color='blue'>Please Wait <i class="fa fa-spinner fa-pulse fa-fw"></i>
                <span class="sr-only">
            </font>
        </td>
    </tr>
    <tr>
        <td>(Do not 'RELOAD' this page or 'CLOSE' this page)</td>
    </tr>
</table>
<h2>
    <script>
        setTimeout(function() {
            window.location = "profile.php";
        }, 3000);
    </script>
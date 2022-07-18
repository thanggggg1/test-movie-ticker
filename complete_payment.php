<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
include('config.php');
session_start();
$bid = mysqli_query($con, "SELECT book_id FROM tbl_bookings ORDER BY book_id desc LIMIT 1");
$bookid = mysqli_fetch_assoc($bid)['book_id'];
if ($bid)
    $ticketid = "TIK" . $bookid;
else $ticketid = "TIK2";
$m = mysqli_query($con, "select movie_name from tbl_movie where movie_id='" . $_SESSION['movie'] . "'");
$mov = mysqli_fetch_array($m);
$st = mysqli_query($con, "select * from tbl_shows where s_id='" . $_SESSION['show'] . "'");
$stm = mysqli_fetch_array($st);
$s = mysqli_query($con, "select room_name from tbl_rooms where room_id ='" . $stm['room_id'] . "'");
$srn = mysqli_fetch_array($s);

mysqli_query($con, "INSERT into tbl_bookings values(NULL,'$ticketid','" . $_SESSION['user'] . "','" . $stm['s_id'] . "','" . $stm['start_time'] . "','" . $srn['room_name'] . "','" . $mov['movie_name'] . "','" . $_SESSION['seats'] . "','" . $_SESSION['amount'] . "','" . $_SESSION['date'] . "',CURDATE(),'1')");
$seats_booked = explode(" ", $_SESSION['seats']);
$bookid++;
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
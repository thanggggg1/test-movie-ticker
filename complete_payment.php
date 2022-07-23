<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
include('config.php');
session_start();
$ticketid = "TIK";
mysqli_query($con, "INSERT into tbl_bookings values(NULL,'$ticketid','" . $_SESSION['user'] . "','" . $_SESSION['total_amount'] . "',CURDATE(),NULL)");
$bid = mysqli_query($con, "SELECT book_id FROM tbl_bookings ORDER BY book_id desc LIMIT 1");
$bookid = mysqli_fetch_assoc($bid)['book_id'];
$ticketid = "TIK" . $bookid;
mysqli_query($con, "UPDATE tbl_bookings SET ticket_id = '$ticketid' WHERE book_id = '$bookid'");
if (!empty($_SESSION['combo_id'])) {
    mysqli_query($con, "UPDATE tbl_bookings SET combo_id = '" . $_SESSION['combo_id'] . "' WHERE book_id = '$bookid'");
}
$seats_booked = $_SESSION['seatings'];
$seats_price = $_SESSION['price_seat'];
foreach ($seats_booked as $seat) {
    if ($seat) {
        $query = mysqli_query($con, "INSERT INTO tbl_tickets VALUES('" . $_SESSION['show'] . "','$bookid','$seat','" . $seats_price[$seat] . "')");
    }
}
$_SESSION['success'] = "Bookings Done!";
unset($_SESSION['show']);
unset($_SESSION['movie']);
unset($_SESSION['seatings']);
unset($_SESSION['price_seat']);
unset($_SESSION['amount']);
unset($_SESSION['date']);
unset($_SESSION['seats']);
unset($_SESSION['combo_id']);
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
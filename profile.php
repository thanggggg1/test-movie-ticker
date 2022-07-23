<?php include('header.php');
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
?>
<?php
if (isset($_SESSION['success'])) {
?>
    <script>
        alert("<?php echo $_SESSION['success']; ?>");
    </script>
<?php
    unset($_SESSION['success']);
}
?>
<div class="content">
    <div class="wrap">
        <div class="content-top">
            <div class="section group">
                <div class="about span_1_of_2">
                    <h3 style="color:black;" class="text-center">RECENT BOOKINGS </h3>
                    <?php include('msgbox.php'); ?>
                    <?php
                    $bk = mysqli_query($con, "select * from tbl_bookings where user_id='" . $_SESSION['user'] . "'");
                    if (mysqli_num_rows($bk)) {

                    ?>
                        <table class="table table-bordered">
                            <thead>
                                <th>Booking Id</th>
                                <th>Movie</th>
                                <th>Room</th>
                                <th>Show</th>
                                <th>Seats</th>
                                <th>Combo/Discount</th>
                                <th>Amount</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                while ($bkg = mysqli_fetch_array($bk)) {
                                    $tk = mysqli_query($con, "SELECT DISTINCT s_id FROM tbl_tickets WHERE book_id ='" . $bkg['book_id'] . "'");
                                    if (mysqli_num_rows($tk)) {
                                        $tid = mysqli_fetch_array($tk);

                                        $info = mysqli_query($con, "SELECT m.movie_name,r.room_name,s.start_time,s.start_date FROM tbl_shows AS s INNER JOIN tbl_movie AS m ON m.movie_id = s.movie_id INNER JOIN tbl_rooms AS r ON r.room_id = s.room_id WHERE s.s_id = '" . $tid['s_id'] . "'");
                                        $tik = mysqli_fetch_array($info);
                                        $seat_booked = mysqli_query($con, "SELECT seat_id FROM tbl_tickets WHERE book_id ='" . $bkg['book_id'] . "'");
                                        $cb =  mysqli_query($con, "SELECT `desc` FROM tbl_combos WHERE combo_id ='" . $bkg['combo_id'] . "'");
                                        $combo = mysqli_fetch_array($cb);
                                ?>
                                        <tr>
                                            <td style="word-wrap: break-word" width=10%>
                                                <?php echo $bkg['ticket_id']; ?>
                                            </td>
                                            <td style="word-wrap: break-word" width=20%>
                                                <?php echo $tik['movie_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $tik['room_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $tik['start_time'] . '<br/>' . $tik['start_date']; ?>
                                            </td>
                                            <td style="word-wrap: break-word">
                                                <?php
                                                while ($seat = mysqli_fetch_array($seat_booked)) {
                                                    echo $seat['seat_id'] . ' ';
                                                }
                                                ?>
                                            </td>
                                            <td style="word-wrap: break-word" width=15%>
                                                <?php echo $combo['desc']; ?>
                                            </td>
                                            <td>
                                                <b><?php echo $bkg['amount']; ?> 000 <u>đ</u></b>
                                            </td>
                                            <td>
                                                <?php if ($tik['start_date'] > date('Y-m-d', strtotime(date('Y-m-d') . '+3 days'))) {
                                                ?>
                                                    <a href="cancel.php?id=<?php echo $bkg['book_id']; ?>" style="text-decoration:none; color:red;">Cancel</a>
                                                <?php
                                                } else { ?>
                                                    <i class="glyphicon glyphicon-ok"></i>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                    ?>
                        <h3 style="color:red;" class="text-center">No Previous Bookings Found!</h3>
                        <p>Once you start booking movie tickets with this account, you'll be able to see all the booking history.</p>
                    <?php
                    }
                    ?>
                </div>
                <?php include('movie_sidebar.php'); ?>

            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
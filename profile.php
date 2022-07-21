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
                    <h3 style="color:black;" class="text-center">BOOKING HISTORY</h3>
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
                                ?>
                                    <tr>
                                        <td style="word-wrap: break-word" width=10%>
                                            <?php echo $bkg['ticket_id']; ?>
                                        </td>
                                        <td style="word-wrap: break-word" width=20%>
                                            <?php echo $bkg['movie_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $bkg['room_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $bkg['show_time'] . '<br/>' . $bkg['ticket_date']; ?>
                                        <td style="word-wrap: break-word">
                                            <?php echo $bkg['seats']; ?>
                                        </td>
                                        <td style="word-wrap: break-word" width=15%>
                                            <?php echo $bkg['combo_desc']; ?>
                                        </td>
                                        <td>
                                            <b><?php echo $bkg['amount']; ?> 000 <u>đ</u></b>
                                        </td>
                                        <td>
                                            <?php if ($bkg['ticket_date'] > date('Y-m-d') || (($bkg['ticket_date'] == date('Y-m-d')) && ($bkg['show_time'] > date('H:i:s')))) {
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
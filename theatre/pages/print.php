<?php include('../../config.php');
session_start();
if (!isset($_SESSION['assistant'])) {
    header("location:../index.php");
}
if (!isset($_GET['id'])) {
    header("location:view_bookings.php");
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../css/flexslider.css" type="text/css" media="all" />
    <link type="text/css" rel="stylesheet" href="http://www.dreamtemplate.com/dreamcodes/tabs/css/tsc_tabs.css" />
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </body>

</html>
<title>Print Tickets</title>
</head>

<body class="hold-transition skin-blue sidebar-mini"">
<div class=" main-header">
    <!-- Logo -->
    <a href="view_bookings.php" class="logo">
        <!-- logo for regular state and mobile devices -->
        <span><b>Theatre</b> Assistant</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            </ul>
        </div>
    </nav>
    </div>
    <div class="clear"></div>
    <div class="content">
        <div class="wrap">
            <div class="content-top">
                <center>
                    <h1 style="color:#555;">Please connect to A Ticketing Application ...</h1>
                </center>
            </div>
            <br>
            <div>
                <a href="view_bookings.php" class="logo">
                    <!-- logo for regular state and mobile devices -->
                    <span style="font-size:150%;">&lt; Return to <b>View Bookings</b></span>
                </a>
            </div>
            <?php
            $qry2 = mysqli_query($con, "select DISTINCT s_id from  tbl_tickets where book_id ='" . $_GET['id'] . "'");
            $tid = mysqli_fetch_array($qry2);
            $info = mysqli_query($con, "SELECT m.movie_name,r.room_name,s.start_time,s.start_date FROM tbl_shows AS s INNER JOIN tbl_movie AS m ON m.movie_id = s.movie_id INNER JOIN tbl_rooms AS r ON r.room_id = s.room_id WHERE s.s_id = '" . $tid['s_id'] . "'");
            $tik = mysqli_fetch_array($info);
            $seat_booked = mysqli_query($con, "SELECT seat_id,price FROM tbl_tickets WHERE book_id ='" .  $_GET['id']  . "'");
            while ($seat = mysqli_fetch_array($seat_booked)) {
            ?>
                <div class="col_1_of_4 span_1_of_4">
                    <div class="box" style="background-image: url('ticket.png');">
                        <div class="box-header with-border">
                            <h3 class="box-title">Movie Ticket</h3>
                        </div>
                        <div class="box-body">
                            Copy2: <b>Customer</b><br>
                            ID: <i><?php echo $_GET['id'] . '-TIK' . $_GET['id'] . $seat['seat_id'] ?></i><br>
                            Export Time: <?php echo date('Y-m-d H:i:s'); ?>
                        </div>
                        <div class="box-body">
                            <b>RHUST CINEMA </b><br>
                            D9-501, 1 Dai Co Viet, Hai Ba Trung, Ha Noi
                        </div>
                        <div class="box-body">
                            <b> <?php echo strtoupper($tik['movie_name']); ?> </b><br>
                            <?php echo $tik['start_date'] . '  ' . $tik['start_time']; ?><br>
                            Cinema: <?php echo $tik['room_name']; ?> <b><?php echo '[' . $seat['seat_id'] . ']'; ?></b>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <tr>
                                    <td><b><?php echo 'Price' ?></b></td>
                                    <td style="text-align:right;"> <b><?php echo 'VND ' . $seat['price'] . ' 000' ?> </b> </td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td style="text-align:right;"> Online </td>
                                </tr>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td style="text-align:right;"> <b><?php echo 'VND ' .  $seat['price'] . ' 000' ?> </b> </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
        <div class="clear"></div>
    </div>
    </div>
</body>

</html>
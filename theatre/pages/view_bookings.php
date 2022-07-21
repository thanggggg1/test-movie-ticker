<?php
include('header.php');
?>
<!-- =============================================== -->
<?php
if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] == "error") {
?>
        <script>
            alert("Can't find any movie!");
        </script>
    <?php
    }
    unset($_SESSION['status']);
}
if (isset($_SESSION['success'])) {
    ?>
    <script>
        alert("Booking Cancelled Successfully");
    </script>
<?php
    unset($_SESSION['success']);
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View Bookings
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">View Bookings</li>
        </ol>
        <br>
        <div class="block">
            <div class="wrap">

                <form action="process_search_bookid.php" id="reservation-form" method="get" onsubmit="myFunction()">
                    <fieldset>
                        <div class="field">


                            <input type="text" placeholder="Enter A Booking ID" style="height:30px;width:300px" required id="search222" name="search">

                            <input type="submit" value="Search" style="height:34px;padding-top:3px" id="button111">
                        </div>

                    </fieldset>
                </form>
                <div class="clear"></div>
            </div>
        </div>
        <script>
            function myFunction() {
                if ($('#hero-demo').val() == "") {
                    alert("Please enter a booking id...");
                    return false;
                } else {
                    return true;
                }
            }
        </script>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        ?>
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Recent Booking History</h3>
            </div>
            <div class="box-body">
                <?php
                if (!isset($_GET['bid'])) {
                    $sw = mysqli_query($con, "SELECT * FROM tbl_bookings WHERE date >= (CURDATE()-4)");
                } else {
                    $sw = mysqli_query($con, "SELECT * FROM tbl_bookings WHERE (date >= (CURDATE()-4)) AND book_id = '" . $_GET['bid'] . "'");
                }

                if (mysqli_num_rows($sw)) { ?>
                    <table class="table table-bordered">
                        <thead>
                            <th>Booking Id</th>
                            <th>User Info</th>
                            <th>Movie</th>
                            <th>Room</th>
                            <th>Show</th>
                            <th>Seats</th>
                            <th>Combo/Discount</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            while ($bkg = mysqli_fetch_array($sw)) {
                            ?>
                                <tr>
                                    <td style="word-wrap: break-word" width=10%>
                                        <?php echo $bkg['ticket_id']; ?>
                                    </td>
                                    <td width=5%>
                                        <div class="tools">
                                            <button class="fa fa-user" onclick="viewuser(<?php echo $bkg['user_id']; ?>)"></button>
                                        </div>
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
                                    <td width=10%>
                                        <?php if ($bkg['ticket_date'] > date('Y-m-d') || (($bkg['ticket_date'] == date('Y-m-d')) && ($bkg['show_time'] > date('H:i:s')))) {
                                        ?>
                                            <a href="print.php?id=<?php echo $bkg['book_id']; ?>"> <button class="btn btn-primary" style="width: 60px;">Print</button> </a>
                                            <a href="cancel.php?id=<?php echo $bkg['book_id']; ?>&s_id=<?php echo $bkg['s_id'] ?>"> <button class="btn btn-danger" style="width: 60px;">Cancel</button> </a>
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
                    <h3>No Recent Booking</h3>
                <?php
                }
                ?>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<?php
include('footer.php');
?>
<script>
    function viewuser(m) {
        window.location = "view_users.php?uid=" + m;
    }
</script>
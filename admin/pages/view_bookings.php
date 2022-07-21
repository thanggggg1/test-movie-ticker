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
?>
<link rel="stylesheet" href="../../validation/dist/css/bootstrapValidator.css" />

<script type="text/javascript" src="../../validation/dist/js/bootstrapValidator.js"></script>
<?php
include('../../form.php');
$frm = new formBuilder;
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
        <form action="view_bookings.php" method="get" enctype="multipart/form-data" id="form1">

            <div class="form-group">
                <label class="control-label">Choose Date</label>
                <table>
                    <td>
                        <input type="date" name="date" class="form-control" style="width: 300px;" />
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </td>
                </table>
                <?php $frm->validate("date", array("required", "label" => "Choose Date")); // Validating form using form builder written in form.php 
                ?>
            </div>
        </form>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        if (!isset($_GET['bid'])) {
            if (isset($_GET['date'])) {
                $sw = mysqli_query($con, "SELECT * FROM tbl_bookings WHERE date ='" . $_GET['date'] . "'");
                $title = 'Recent Booking History ' . $_GET['date'];
            } else {
                $sw = mysqli_query($con, "SELECT * FROM tbl_bookings WHERE date = CURDATE()");
                $title = 'Recent Booking History ' . date('Y-m-d');
            }

        ?>
            <p>
                <a href="view_bookings.php?date= <?php echo date('Y-m-d', strtotime($_GET['date'] . "-1 days")); ?>" style="font-size:100%">
                    < Previous day </a>
                        <span class="tab"></span>
                        <a href="view_bookings.php?date= <?php echo date('Y-m-d', strtotime($_GET['date'] . "+1 days")); ?>" style="font-size:100%"> Next day ></a>
            </p>
        <?php
        } else {
            $sw = mysqli_query($con, "SELECT * FROM tbl_bookings WHERE book_id = '" . $_GET['bid'] . "'");
            $title = 'Recent Booking History';
        } ?>
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <div class="box-body">
                <?php
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
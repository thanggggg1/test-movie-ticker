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
            View Shows
            <a href="update_show.php"> <button class="btn btn-danger">Update Show</button> </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">View Shows</li>
        </ol>
        <br>
        <form action="view_shows.php" method="get" enctype="multipart/form-data" id="form1">

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
        if (!isset($_GET['mid'])) {
            if (isset($_GET['date'])) {
                $sw = mysqli_query($con, "SELECT * FROM tbl_shows WHERE start_date ='" . $_GET['date'] . "' ORDER BY room_id ASC, start_time");
                $title = 'Available Shows On ' . $_GET['date'];
            } else {
                $sw = mysqli_query($con, "SELECT * FROM tbl_shows WHERE start_date = CURDATE() ORDER BY room_id ASC, start_time");
                $title = 'Available Shows On ' . date('Y-m-d');
            }

        ?>
            <p>
                <a href="view_shows.php?date= <?php echo date('Y-m-d', strtotime($_GET['date'] . "-1 days")); ?>" style="font-size:100%">
                    < Previous day </a>
                        <span class="tab"></span>
                        <a href="view_shows.php?date= <?php echo date('Y-m-d', strtotime($_GET['date'] . "+1 days")); ?>" style="font-size:100%"> Next day ></a>
            </p>
        <?php
        } else {
            $sw = mysqli_query($con, "SELECT * FROM tbl_shows WHERE (start_date >= CURDATE()) AND movie_id = '" . $_GET['mid'] . "' ORDER BY room_id ASC, start_time");
            $title = 'Available Shows';
        } ?>

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <div class="box-body">
                <?php

                if (mysqli_num_rows($sw)) { ?>
                    <table class="table">
                        <th class="col-md-1">
                            Sl.no
                        </th>
                        <th class="col-md-1">
                            Room
                        </th>
                        <th class="col-md-2">
                            Show Time
                        </th>
                        <th class="col-md-2">
                            Show Date
                        </th>
                        <th class="col-md-3">
                            Movie
                        </th>
                        <th></th>
                        <?php
                        $sl = 1;
                        while ($shows = mysqli_fetch_array($sw)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $sl;
                                    $sl++; ?>
                                </td>
                                <?php
                                $sr = mysqli_query($con, "select * from tbl_rooms where room_id='" . $shows['room_id'] . "'");
                                $screen = mysqli_fetch_array($sr);
                                $mv = mysqli_query($con, "select * from tbl_movie where movie_id='" . $shows['movie_id'] . "'");
                                $movie = mysqli_fetch_array($mv);
                                ?>
                                <td>
                                    <?php echo $screen['room_name']; ?>
                                </td>
                                <td>
                                    <?php echo date('h:i A', strtotime($shows['start_time'])); ?>
                                </td>
                                <td>
                                    <?php echo $shows['start_date'] ?>
                                </td>
                                <td>
                                    <?php echo $movie['movie_name']; ?>
                                </td>
                                <td>
                                    <?php
                                    $today = date('Y-m-d');
                                    $now = date('H:i:s');
                                    if ($shows['start_date'] >= $today) {
                                        $sh = mysqli_query($con, "SELECT s_id FROM tbl_tickets WHERE s_id = '" . $shows['s_id'] . "'");
                                        if (mysqli_num_rows($sh)) {
                                            if ($shows['start_date'] == $today) {
                                                if ($shows['start_time'] > $now) {
                                    ?>
                                                    <span class="badge bg-blue">Showing soon... </span>
                                                <?php
                                                } else if (($shows['end_time'] < $now)) {
                                                ?>
                                                    <i class="glyphicon glyphicon-ok"></i>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="badge bg-red">Showing</span>
                                                <?php
                                                }
                                            } else if ($shows['start_date'] > $today) {
                                                ?>
                                                <span class="badge bg-green">Waiting for the show date ... </span>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <button class="fa fa-trash-o" onclick="del(<?php echo $shows['s_id']; ?>)"></button>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <i class="glyphicon glyphicon-ok"></i>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                } else {
                ?>
                    <h3>No Shows Added</h3>
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
    <?php $frm->applyvalidations("form1"); ?>
</script>
<script>
    function del(m) {
        if (confirm("Are you want to delete this show") == true) {
            window.location = "process_delete_show.php?sid=" + m;
        }
    }
</script>
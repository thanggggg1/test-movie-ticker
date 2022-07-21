<?php
include('header.php');
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Theatre Assistance
        </h1>
        <ol class="breadcrumb">
            <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Home</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Running Show</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-3">Show Time</th>
                                <th class="col-md-4">Room</th>
                                <th class="col-md-4">Movie</th>
                            </tr>
                            <?php
                            $qry8 = mysqli_query($con, "SELECT * FROM tbl_shows WHERE ((start_time <= CURRENT_TIME()) AND (end_time >= CURRENT_TIME()) AND (start_date = CURDATE()))");
                            $no = 1;
                            while ($mn = mysqli_fetch_array($qry8)) {
                                $qry9 = mysqli_query($con, "select * from tbl_movie where movie_id='" . $mn['movie_id'] . "'");
                                $mov = mysqli_fetch_array($qry9);
                                $qry10 = mysqli_query($con, "select * from tbl_rooms where room_id='" . $mn['room_id'] . "'");
                                $scn = mysqli_fetch_array($qry10);
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><span class="badge bg-green"><?php echo $mn['start_time']; ?></span></td>
                                    <td><span class="badge bg-light-blue"><?php echo $scn['room_name']; ?></span></td>
                                    <td><?php echo $mov['movie_name']; ?></td>
                                </tr>
                            <?php
                                $no = $no + 1;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>


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
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View Shows
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">View Shows</li>
        </ol>
        <br>
        <div class="block">
            <div class="wrap">

                <form action="process_search_bymovie.php" id="reservation-form" method="get" onsubmit="myFunction()">
                    <fieldset>
                        <div class="field">


                            <input type="text" placeholder="Enter A Movie Name" style="height:30px;width:300px" required id="search111" name="search">

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
                    alert("Please enter movie name...");
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
                <h3 class="box-title">Available Shows</h3>
            </div>
            <div class="box-body">
                <?php
                if (!isset($_GET['mid'])) {
                    $sw = mysqli_query($con, "SELECT * FROM tbl_shows WHERE start_date >= CURDATE()");
                } else {
                    $sw = mysqli_query($con, "SELECT * FROM tbl_shows WHERE (start_date >= CURDATE()) AND movie_id = '" . $_GET['mid'] . "'");
                }

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
                                    if ($shows['start_date'] == $today) {
                                        if ($shows['start_time'] > $now) {
                                    ?>
                                            <span class="badge bg-light-blue">Showing soon</span>
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
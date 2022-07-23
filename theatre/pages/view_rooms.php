<?php
include('header.php');
?>
<!-- =============================================== -->
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Theatre Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Theater Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div style="text-align:left; font-size: 120%">

            <b>Address</b>: D9-501, 1 Dai Co Viet Street, Hai Ba Trung, Ha Noi<br>
            <b>Contact</b>: <i>0314159265</i>
        </div>
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Room Details</h3>
            </div>

            <div class="box-body" id="screendtls">
                <?php
                $sr = mysqli_query($con, "select r.room_id,r.room_name,t.* from tbl_rooms as r inner join tbl_roomtypes as t on r.type_id = t.type_id order by t.type_id ASC,r.room_name");
                if (mysqli_num_rows($sr)) {
                ?>
                    <table class="table table-bordered table-hover">
                        <th class="col-md-1">Slno</th>
                        <th class="col-md-2">Room Name</th>
                        <th class="col-md-1">Type</th>
                        <th class="col-md-1">No.seats</th>
                        <th class="col-md-1">No.vipseats</th>
                        <th class="col-md-2">Charge</th>
                        <th class="col-md-2">VIP Charge</th>
                        <?php
                        $sl = 1;
                        while ($screen = mysqli_fetch_array($sr)) {
                        ?>
                            <tr>
                                <td><?php echo $sl; ?></td>
                                <td><?php echo $screen['room_name']; ?></td>
                                <td><?php echo $screen['type_name']; ?></td>
                                <td><?php echo $screen['seats']; ?></td>
                                <td><?php echo $screen['vip']; ?></td>
                                <td><?php echo $screen['charge']; ?></td>
                                <td><?php echo $screen['vip_charge']; ?></td>
                            </tr>
                        <?php
                            $sl++;
                        }
                        ?>
                    </table>
                <?php
                } else {
                ?>
                    <h3>No Room yet</h3>

                <?php
                }
                ?>
            </div>
            <!-- /.box-footer-->
        </div>
    </section>
</div>
<?php
include('footer.php');
?>
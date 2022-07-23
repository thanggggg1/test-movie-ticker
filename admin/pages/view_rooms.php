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
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">General Details</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover" padding: 15px>
                    <?php
                    $rt = mysqli_query($con, "select * from tbl_roomtypes"); ?>
                    <tr>
                        <td><b>Room type</b></td>
                        <td class="col-md-1"> <b> No.seats</b></td>
                        <td class="col-md-1"><b>No.vipseats</b></td>
                        <td class="col-md-2"><b>Charge</b></td>
                        <td class="col-md-2"><b>VIP Charge</b></td>
                        <td rowspan="<?php echo mysqli_num_rows($rt) + 1 ?>" style="text-align:right; font-size:140%" class="col-md-3">
                            <b>Address</b><br>
                            D9-501<br>
                            1 Dai Co Viet Street<br>
                            Hai Ba Trung District<br>
                            Ha Noi Capital<br>
                            <b>Contact</b><br>
                            <i>0314159265</i>
                        </td>

                    </tr>
                    <?php
                    while ($roomtype = mysqli_fetch_array($rt)) {
                    ?>
                        <tr>
                            <td><?php echo $roomtype['type_name']; ?></td>
                            <td><?php echo $roomtype['seats']; ?></td>
                            <td><?php echo $roomtype['vip']; ?></td>
                            <td><?php echo $roomtype['charge']; ?></td>
                            <td><?php echo $roomtype['vip_charge']; ?></td>
                        </tr>

                    <?php } ?>
                </table>
            </div>
            <!-- /.box-footer-->
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
                        <th class="text-right col-md-2"><button data-toggle="modal" data-target="#view-modal" id="getUser" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Room</button></th>
                        <?php
                        $sl = 1;
                        while ($screen = mysqli_fetch_array($sr)) {
                        ?>
                            <tr>
                                <td><?php echo $sl; ?></td>
                                <td><?php echo $screen['room_name']; ?></td>
                                <td><?php echo $screen['type_name']; ?></td>
                                <td style="text-align: right;">
                                    <div class="tools">
                                        <button class="fa fa-trash-o" onclick="del(<?php echo $screen['room_id']; ?>)"></button>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $sl++;
                        }
                        ?>
                    </table>
                <?php
                } else {
                ?>
                    <button data-toggle="modal" data-target="#view-modal" id="getUser" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Room</button>

                <?php
                }
                ?>
            </div>
            <!-- /.box-footer-->
        </div>
        <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            <i class="fa fa-plus"></i> Add Room
                        </h4>
                    </div>
                    <div class="modal-body">

                        <div id="modal-loader" style="display: none; text-align: center;">
                            <img src="ajax-loader.gif">
                        </div>

                        <!-- content will be load here -->
                        <div id="dynamic-content"></div>

                    </div>
                    <div class="modal-footer">

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php
include('footer.php');
?>
<script type="text/javascript">
    var screenid;

    function loadScreendtls() {
        $.ajax({
                url: 'get_screen_dtls.php',
                type: 'POST',
                data: '',
                dataType: 'html'
            })
            .done(function(data) {
                //console.log(data);	
                $('#screendtls').html(data);
            })
            .fail(function() {
                $('#screendtls').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            });
    }
    $(document).ready(function() { // load dynamic bootstrap model

        $(document).on('click', '#getUser', function(e) {

            e.preventDefault();

            $('#dynamic-content').html(''); // leave it blank before ajax call
            $('#modal-loader').show(); // load ajax loader

            $.ajax({
                    url: 'add_room_form.php',
                    type: 'POST',
                    data: '',
                    dataType: 'html'
                })
                .done(function(data) {
                    console.log(data);
                    $('#dynamic-content').html('');
                    $('#dynamic-content').html(data); // load response 
                    $('#modal-loader').hide(); // hide ajax loader	
                })
                .fail(function() {
                    $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modal-loader').hide();
                });

        });

    });
    $(document).on('click', '#savescreen', function() {
        var name = $('#name').val();
        var tid = $('#tid').val();
        if (name != "" && tid != "") {

            $.ajax({
                    url: 'save_room.php',
                    type: 'POST',
                    data: 'name=' + name + '&tid=' + tid,
                    dataType: 'html'
                })
                .done(function(data) {
                    loadScreendtls();
                    $('#view-modal').modal('toggle');
                })
                .fail(function() {
                    loadScreendtls();
                    $('#view-modal').modal('toggle');
                });
        } else {
            alert("Enter Correct Details");
        }

    });
</script>
<script>
    function del(m) {
        if (confirm("Are you want to delete this room") == true) {
            window.location = "process_delete_room.php?rid=" + m;
        }
    }
</script>
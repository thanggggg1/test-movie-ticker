<?php
include('header.php');
?>
<link rel="stylesheet" href="../../validation/dist/css/bootstrapValidator.css" />

<script type="text/javascript" src="../../validation/dist/js/bootstrapValidator.js"></script>
<!-- =============================================== -->

<?php
include('../../form.php');
$frm = new formBuilder;
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Show
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Add Show</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <?php include('../../msgbox.php'); ?>
                <form action="process_add_show.php" method="post" enctype="multipart/form-data" id="form1">
                    <div class="form-group">
                        <label class="control-label">Select Movie</label>
                        <select name="movie" class="form-control">
                            <option value>Select Movie</option>
                            <?php
                            $mv = mysqli_query($con, "select * from tbl_movie where release_date <= CURDATE()");
                            while ($movie = mysqli_fetch_array($mv)) {
                            ?>
                                <option value="<?php echo $movie['movie_id']; ?>"><?php echo $movie['movie_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php $frm->validate("movie", array("required", "label" => "Movie")); // Validating form using form builder written in form.php 
                        ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Select Room</label>
                        <select name="room" class="form-control">
                            <option value>Select Room</option>
                            <?php
                            $sc = mysqli_query($con, "select * from tbl_rooms");
                            while ($screen = mysqli_fetch_array($sc)) {
                            ?>
                                <option value="<?php echo $screen['room_id']; ?>"><?php echo $screen['room_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php $frm->validate("room", array("required", "label" => "Room")); // Validating form using form builder written in form.php 
                        ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Start Date</label>
                        <input type="date" name="sdate" class="form-control" />
                        <?php $frm->validate("sdate", array("required", "label" => "Start Date")); // Validating form using form builder written in form.php 
                        ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Start Time</label>
                        <input type="time" name="stime" class="form-control" />
                        <?php $frm->validate("stime", array("required", "label" => "Start Time")); // Validating form using form builder written in form.php 
                        ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Add Show</button>
                    </div>
                </form>
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
<?php
if (isset($_SESSION['success'])) {
?>
    <script>
        alert("Add movie successfully");
    </script>
<?php
    unset($_SESSION['success']);
}
?>
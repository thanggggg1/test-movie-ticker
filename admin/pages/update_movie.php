<?php
if (!isset($_GET['mid'])) {
    header("location: index.php");
}
include('header.php');
unset($_FILE["image"]);
?>
<link rel="stylesheet" href="../../validation/dist/css/bootstrapValidator.css" />

<script type="text/javascript" src="../.movie_id = '$id'./validation/dist/js/bootstrapValidator.js"></script>
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
            Add Movie
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Add Movie</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <?php
                $mv = mysqli_query($con, "SELECT * FROM tbl_movie WHERE movie_id = '" . $_GET['mid'] . "'");
                if (mysqli_num_rows($mv)) {
                    $movie = mysqli_fetch_array($mv);
                ?>
                    <?php include('../../msgbox.php'); ?>
                    <form action="process_update_movie.php" method="post" enctype="multipart/form-data" id="form1">
                        <input type="hidden" name="id" value="<?php echo $_GET['mid'];  ?>" />
                        <div class="form-group">
                            <label class="control-label">Movie Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $movie['movie_name'] ?>" />
                            <?php $frm->validate("name", array("required", "label" => "Movie Name")); // Validating form using form builder written in form.php 
                            ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Cast</label>
                            <input type="text" name="cast" class="form-control" value="<?php echo $movie['cast'] ?>" />
                            <?php $frm->validate("cast", array("required", "label" => "Cast", "regexp" => "text")); // Validating form using form builder written in form.php 
                            ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="desc" class="form-control" id="desc"><?php echo $movie['desc']; ?></textarea>
                            <?php $frm->validate("desc", array("required", "label" => "Description")); // Validating form using form builder written in form.php 
                            ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Release Date</label>
                            <input type="date" name="rdate" class="form-control" value="<?php echo $movie['release_date'] ?>" />

                            <?php $frm->validate("rdate", array("required", "label" => "Release Date")); // Validating form using form builder written in form.php 
                            ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input type="file" name="image" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Trailer Youtube Link</label>
                            <input type="text" name="video" class="form-control" value="<?php echo $movie['video_url'] ?>" />
                            <?php $frm->validate("video", array("required", "label" => "Video")); // Validating form using form builder written in form.php 
                            ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Length</label>
                            <input type="number" name="length" class="form-control" value="<?php echo $movie['length'] ?>" />
                            <?php $frm->validate("length", array("required", "label" => "Length")); // Validating form using form builder written in form.php 
                            ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Update Movie</button>
                        </div>
                    </form>
                <?php
                } else {
                ?>
                    <h4>No movie found!</dh4>
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
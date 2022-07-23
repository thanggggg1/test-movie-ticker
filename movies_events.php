<?php include('header.php'); ?>
</div>
<div class="content">
    <div class="wrap">
        <div class="content-top">
            <center>
                <h2 style="color:#555;">(NOW SHOWING)</h2>
            </center>

            <?php
            $today = date("Y-m-d");
            $qry2 = mysqli_query($con, "select * from  tbl_movie where release_date <= CURDATE()");

            while ($m = mysqli_fetch_array($qry2)) {
            ?>
                <div class="col_1_of_4 span_1_of_4">
                    <div class="imageRow">
                        <div class="single">
                            <a href="about.php?id=<?php echo $m['movie_id']; ?>"><img src="<?php echo $m['image']; ?>" alt="" style="width: 259px; height: 383px; object-fit: fill;" /></a>
                        </div>
                        <div class="movie-text">
                            <h4 class="h-text"><a href="about.php?id=<?php echo $m['movie_id']; ?>" style="text-decoration:none;"><?php echo $m['movie_name']; ?></a></h4>
                            Cast: <Span class="color2" style="text-decoration:none;"><?php echo $m['cast']; ?></span><br>

                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
        <div class="clear"></div>
    </div>
    <?php include('footer.php'); ?>
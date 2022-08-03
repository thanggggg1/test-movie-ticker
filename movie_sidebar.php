<!-- <div>
    <h2 style="color:#555;">Films in Theaters</h2>

    <?php
    $today = date("Y-m-d");
    $qry2 = mysqli_query($con, "select * from  tbl_movie where release_date <= CURDATE() order by rand() limit 5");

    while ($m = mysqli_fetch_array($qry2)) {
    ?>
        <div class="listview_row">
            <div class="listview_image">
                <?php
                ?>
                <a href="about.php?id=<?php echo $m['movie_id']; ?>"><img src="<?php echo $m['image']; ?>"  ></a>
            </div>
            <div >
                <div >
                    <a href="about.php?id=<?php echo $m['movie_id']; ?>" style="text-decoration:none; font-size:18px;"><?php echo $m['movie_name']; ?></a><br>
                    <span >Release Date: <?php echo $m['release_date']; ?></span><br>
                    Cast: <Span ><?php echo $m['cast']; ?></span><br>
                    Description: <span"  style="text-decoration:none;display: -webkit-box; height: 90px;-webkit-line-clamp: 3;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;"><?php echo $m['desc']; ?></span><br>
                </div>
            </div>
            <div></div>
        </div>
    <?php
    }
    ?>
</div> -->
<?php
$today = date("Y-m-d");
$qry2 = mysqli_query($con, "select * from  tbl_movie where release_date <= CURDATE() order by rand() limit 5");
                    while ($m = mysqli_fetch_array($qry2)) {
                    ?>
                        <div class="listview_row">
                            <div class="div_image">
                            <a href="about.php?id=<?php echo $m['movie_id']; ?>"><img src="<?php echo $m['image']; ?>" ></a>
                            </div>
                            <div class="div_text">
                                <h3 style="color:red;margin-top:0"><?php echo $m['movie_name']; ?></h3>
                                <p style="color:blue;font-weight:600">Cast:
                                    <span style="color:#333"><?php echo $m['cast']; ?></span>
                                </p>
                                <p style="color:blue;font-weight:600">Release Date: 
                                    <span style="color:#333"><?php echo $m['release_date']; ?></span>
                                </p>
                                <p style="color:#9b9b9e" class="max-lines"><?php echo $m['desc']; ?></p>


                            </div>

                        </div>
                    <?php
                    }
                    ?>

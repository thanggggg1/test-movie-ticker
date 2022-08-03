<html>

<body>
    <?php
    include('header.php');
    ?>

    <div class="content">
        <!-- <div class="wrap">
            <div class="listview_row">
                <div>
                    <h2 style="color:#555;">Upcoming Movies</h2>
                    <?php
                    $qry3 = mysqli_query($con, "SELECT * FROM tbl_movie WHERE release_date > CURDATE() LIMIT 5");

                    while ($n = mysqli_fetch_array($qry3)) {
                    ?>
                        <div>
                            <div  class="listview_image" >
                                <img src="<?php echo $n['image']; ?>">
                            </div>
                            <div >
                                <div >
                                    <span style="text-color:#000" ><strong><?php echo $n['movie_name']; ?></strong><br>
                                        <span style="text-color:#000" ><strong>Cast :<?php echo $n['cast']; ?></strong><br>
                                            <div >Release Date :<?php echo $n['release_date']; ?></div>
                                            <span ><?php echo $n['desc']; ?></span>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            
            </div>
        </div> -->
        <div class="wrap">
            <div class="listview_row">
                <div class="left ">
                    <h2>Upcoming Movies</h2>
                    <?php
                    $qry3 = mysqli_query($con, "SELECT * FROM tbl_movie WHERE release_date > CURDATE() LIMIT 5");

                    while ($n = mysqli_fetch_array($qry3)) {
                    ?>
                        <div class="listview_row">
                            <div class="div_image">
                                <img src="<?php echo $n['image']; ?>">
                            </div>
                            <div class="div_text">
                                <h3 style="color:red;margin-top:0"><?php echo $n['movie_name']; ?></h3>
                                <p style="color:blue;font-weight:600">Cast:
                                    <span style="color:#333"><?php echo $n['cast']; ?></span>
                                </p>
                                <p style="color:blue;font-weight:600">Release Date: 
                                    <span style="color:#333"><?php echo $n['release_date']; ?></span>
                                </p>
                                <p style="color:#9b9b9e"><?php echo $n['desc']; ?></p>


                            </div>

                        </div>
                    <?php
                    }
                    ?>

                </div>
                <div class="right">
                <h2>Films in Theaters</h2>
                    <?php include('movie_sidebar.php') ?>


                </div>

            </div>
        </div>

        <?php include('footer.php'); ?>
    </div>
    <?php include('searchbar.php'); ?>
<?php include('header.php'); ?>
</div>
<div class="content">
    <div class="wrap">
        <div class="content-top">
            <center>
                <h1 style="color:#555;">(COMBOS AND DISCOUNTS)</h1>
            </center>
            <a href="booking.php">
                <p style="font-size:120%">
                    < Go Back To Booking Page</p>
            </a>
            <?php
            $today = date("Y-m-d");
            $qry2 = mysqli_query($con, "select * from  tbl_combos ");

            while ($cb = mysqli_fetch_array($qry2)) {
                if ($today < $cb['start_date'] || $today > $cb['end_date']) continue;
                if ($cb['week_date'] != '0' && $cb['week_date'] != date('w')) {
                    continue;
                }
            ?>

                <div class="col_1_of_4 span_1_of_4">
                    <div class="imageRow">
                        <div class="single">
                            <?php

                            ?>
                            <a href="booking.php?combo_id=<?php echo $cb['combo_id']; ?>"><img src="<?php echo $cb['image']; ?>" alt="" style="width: 240px; height: 204px; object-fit: fill;" /></a>
                        </div>
                        <div class="movie-text">
                            <h4 class="h-text"><a href="booking.php?combo_id=<?php echo $cb['combo_id']; ?>" style="text-decoration:none;"><?php echo $cb['desc']; ?></a></h4>
                            Amount: <Span class="color2" style="text-decoration:none;"><?php echo $cb['amount']; ?></span><br>

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
<?php
include('header.php');
unset($_SESSION['seatings']);
unset($_SESSION['amount']);
unset($_SESSION['total_amount']);
unset($_SESSION['combo_id']);
$qry2 = mysqli_query($con, "select * from tbl_movie where movie_id='" . $_GET['id'] . "'");
$movie = mysqli_fetch_array($qry2);
?>
<div class="content">
    <div class="wrap">
        <div class="content-top">
            <div class="section group">
                <div class="about span_1_of_2">
                    <h3 style="color:#444; font-size:23px;" class="text-center"><?php echo $movie['movie_name']; ?></h3>
                    <div class="about-top">
                        <div class="grid images_3_of_2">
                            <img src="<?php echo $movie['image']; ?>" alt="" />
                        </div>
                        <div class="desc span_3_of_2">
                            <p class="p-link" style="font-size:15px"><b>Cast : </b><?php echo $movie['cast']; ?></p>
                            <p class="p-link" style="font-size:15px"><b>Length : </b><?php echo $movie['length']; ?> minutes</p>
                            <p class="p-link" style="font-size:15px"><b>Release Date : </b><?php echo date('d-M-Y', strtotime($movie['release_date'])); ?></p>
                            <p style="font-size:15px"><?php echo $movie['desc']; ?></p>
                            <a href="<?php echo $movie['video_url']; ?>" target="_blank" class="watch_but" style="text-decoration:none;">Watch Trailer</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                    if ($movie['release_date'] <= date('Y-m-d')) {
                        if (isset($_GET['date'])) {
                            $date = $_GET['date'];
                        } else {
                            $date = date('Y-m-d');
                        }
                    ?>
                        <div class="col-md-12 text-center" style="padding-bottom:20px">
                            <?php $_SESSION['dd'] = date('Y-m-d'); ?>
                            <?php if ($date > $_SESSION['dd']) { ?><a href="about.php?date=<?php echo date('Y-m-d', strtotime($date . "-1 days")); ?>&id=<?php echo $movie['movie_id']; ?>"><button class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i></button></a> <?php } ?><span style="cursor:default" class="btn btn-default"><?php echo date('d-M-Y', strtotime($date)); ?></span>
                            <?php if ($date != date('Y-m-d', strtotime($_SESSION['dd'] . "+4 days"))) { ?>
                                <a href="about.php?date=<?php echo date('Y-m-d', strtotime($date . "+1 days")); ?>&id=<?php echo $movie['movie_id']; ?>"><button class="btn btn-default"><i class="glyphicon glyphicon-chevron-right"></i></button></a>
                            <?php }
                            ?>
                        </div>
                        <table class="table table-hover table-bordered text-center">
                            <h3 style="color:#444;" class="text-center">Available Shows</h3>

                            <thead>
                                <tr>
                                    <th class="text-center" style="font-size:16px;"><b>Show Timings</b></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <?php $tr = mysqli_query($con, "select * from tbl_shows where movie_id='" . $movie['movie_id'] . "'and start_date ='" . $date . "'");
                                    $tr_count = mysqli_num_rows($tr);
                                    if ($tr_count > 0) {
                                    ?>
                                        <td>
                                            <?php
                                            $today = date("Y-m-d");
                                            while ($shh = mysqli_fetch_array($tr)) {
                                            ?>
                                                <a href="check_login.php?show=<?php echo $shh['s_id']; ?>&movie=<?php echo $shh['movie_id']; ?>">
                                                    <?php
                                                    if (($shh['start_time'] <= date('H:i:s')) && ($date == $today)) {
                                                    ?>
                                                        <button class="btn btn-default" disabled><?php echo date('H:i A', strtotime($shh['start_time'])); ?></button>
                                                    <?php
                                                    } else {
                                                    ?>

                                                        <button class="btn btn-default"><?php echo date('H:i A', strtotime($shh['start_time'])); ?></button>
                                                    <?php } ?>
                                                </a>
                                            <?php
                                            }

                                            ?>
                                        </td>
                                    <?php
                                    } else {
                                    ?>
                                        <td style="color:#444; font-size:20px;" class="text-center">Currently there are no any shows available!<br /><small>Please check back later!</small></td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    <?php
                    } else {
                    ?>
                        <p style="color:#444; font-size:20px;" class="text-center">
                            The movie will be shown soon!
                        </p>
                    <?php
                    }
                    ?>
                </div>
                <?php include('movie_sidebar.php'); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
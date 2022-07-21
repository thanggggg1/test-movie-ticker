<?php include('header.php');
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
$qry2 = mysqli_query($con, "select * from tbl_movie where movie_id='" . $_SESSION['movie'] . "'");
$movie = mysqli_fetch_array($qry2);
?>
<div class="content">
    <div class="wrap">
        <div class="content-top">
            <div class="section group">
                <div class="about span_1_of_2">
                    <h3><?php echo $movie['movie_name']; ?></h3>
                    <div class="about-top">
                        <div class="grid images_3_of_2">
                            <img src="<?php echo $movie['image']; ?>" alt="" />
                        </div>
                        <div class="desc span_3_of_2">
                            <p class="p-link" style="font-size:15px"><b>Cast : </b><?php echo $movie['cast']; ?></p>
                            <p class="p-link" style="font-size:15px"><b>Length : </b><?php echo $movie['length']; ?> minutes</p>
                            <p class="p-link" style="font-size:15px"><b>Release Date : </b><?php echo date('d-M-Y', strtotime($movie['release_date'])); ?></p>
                            <p style="font-size:15px"><?php echo $movie['desc']; ?></p>
                            <a href="<?php echo $movie['video_url']; ?>" target="_blank" class="watch_but">Watch Trailer</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <a href="about.php?id= <?php echo $movie['movie_id']; ?>">
                        <p style="font-size:120%">
                            < Go Back</p>
                    </a>
                    <table class="table table-hover table-bordered text-center">
                        <?php
                        $s = mysqli_query($con, "select * from tbl_shows where s_id='" . $_SESSION['show'] . "'");
                        $shw = mysqli_fetch_array($s);
                        ?>
                        <tr>
                            <td colspan="2">
                                Room
                            </td>
                            <td>
                                <?php

                                $sn = mysqli_query($con, "SELECT r.room_id,r.room_name,t.type_name,t.seats,t.vip,t.charge,t.vip_charge FROM tbl_rooms AS r INNER JOIN tbl_roomtypes AS t ON r.type_id = t.type_id WHERE room_id='" . $shw['room_id'] . "'");

                                $screen = mysqli_fetch_array($sn);
                                echo $screen['room_name'] . ' : ' . $screen['type_name'];

                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Date
                            </td>
                            <td>
                                <div class="col-md-12 text-center" style="padding-bottom:20px">
                                    <?php echo $shw['start_date']; ?>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Show Time
                            </td>
                            <td>
                                <?php echo date('h:i A', strtotime($shw['start_time'])); ?> Show
                            </td>
                        </tr>
                        <?php
                        if (isset($_SESSION['seatings'])) {
                        ?>
                            <tr>
                                <td>
                                    Seats
                                    <a href="choosing_seats.php">
                                        Change
                                    </a>
                                </td>
                                <td>
                                    <?php foreach ($_SESSION['seatings'] as $seat) {
                                        echo $seat . " ";
                                    } ?>
                                </td>
                                <td>
                                    <?php
                                    echo $_SESSION['amount'];
                                    ?> 000 <u>đ</u>
                                </td>
                            </tr>

                            <?php
                            if (isset($_GET['combo_id'])) {
                                $cb = mysqli_query($con, "SELECT * FROM tbl_combos WHERE combo_id ='" . $_GET['combo_id'] . "'");
                                $combo = mysqli_fetch_array($cb);
                            ?>
                                <tr>
                                    <td>
                                        Combos
                                        <a href="choosing_combos.php">
                                            Change
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo $combo['desc']; ?>
                                    </td>
                                    <td>
                                        <?php echo $combo['amount']; ?> 000 <u>đ</u>
                                    </td>
                                </tr>
                            <?php
                                if (!isset($_SESSION['total_amount']) || ($_SESSION['total_amount'] != $_SESSION['amount'] + $combo['amount'])) $_SESSION['total_amount'] = $_SESSION['amount'] + $combo['amount'];
                            } else {
                                $_SESSION['total_amount'] = $_SESSION['amount']; ?>
                                <tr>
                                    <td colspan="2">
                                        Combos
                                    </td>
                                    <td>
                                        <form action="choosing_combos.php">
                                            <button type="submit">Select Combos</button>
                                        </form>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="2">
                                    <b> Amount</b>
                                </td>
                                <td>
                                    <b>
                                        <?php echo $_SESSION['total_amount']; ?> 000 <u>đ</u>
                                    </b>
                                </td>
                            </tr>
                        <?php
                        } else {
                        ?>
                            <tr>
                                <td colspan="2">
                                    Seats
                                </td>
                                <td>
                                    <form action="choosing_seats.php">
                                        <button type="submit">Select tickets</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="3">
                                <form action="process_booking.php" method="post">
                                    <input type="hidden" name="combo_id" value="<?php echo ($comboid = isset($_GET['combo_id']) ? $_GET['combo_id'] : NULL) ?>" />
                                    <input type="hidden" name="seats" value="<?php foreach ($_SESSION['seatings'] as $seat) {
                                                                                    echo $seat . " ";
                                                                                } ?>" />
                                    <input type="hidden" name="amount" id="hm" value="<?php echo $_SESSION['total_amount']; ?>" />
                                    <input type="hidden" name="date" value="<?php echo $shw['start_date'] ?>" />
                                    <?php if (!isset($_SESSION['seatings'])) { ?>
                                        <button class="btn btn-info" style="width:100%" disabled>Book Now</button>
                                    <?php } else { ?>
                                        <button class="btn btn-info" style="width:100%">Book Now</button>
                                    <?php } ?>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php include('movie_sidebar.php'); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
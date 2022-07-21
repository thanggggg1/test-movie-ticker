<?php
include('config.php');
session_start();
if (isset($_SESSION['movie']) && isset($_SESSION['show'])) {
    $qry2 = mysqli_query($con, "select movie_name from tbl_movie where movie_id='" . $_SESSION['movie'] . "'");
    $movie = mysqli_fetch_array($qry2);
    $s = mysqli_query($con, "select * from tbl_shows where s_id='" . $_SESSION['show'] . "'");
    $shw = mysqli_fetch_array($s);
    $ro = mysqli_query($con, "SELECT r.room_name,t.seats,t.vip,t.charge,t.vip_charge FROM tbl_rooms AS r INNER JOIN tbl_roomtypes AS t ON r.type_id = t.type_id WHERE room_id='" . $shw['room_id'] . "'");
    $room = mysqli_fetch_array($ro);
    $qry_seats = "SELECT seat_id FROM tmp_seats WHERE s_id ='" . $_SESSION['show'] . "'";
    $seats_choosen = array();
    if (isset($_SESSION['seatings'])) foreach ($_SESSION['seatings'] as $seat_choosen) {
        $seats_choosen[] = $seat_choosen;
    }
    $seats = mysqli_query($con, $qry_seats);
    $seats_booked = array();
    while ($rows = mysqli_fetch_array($seats)) {
        $seats_booked[] = $rows['seat_id'];
    }
    if (count($seats_booked) >= $room['seats']) {
?>
        <script>
            alert("All seats booked,Select another show.");
            setTimeout(function() {
                window.location = "booking.php";
            }, 3000);
        </script>
<?php
    }
} else {
    header('location:index.php');
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Seat Selection</title>
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <link href="css/animate.css" type='text/css' rel="stylesheet">

    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">

</head>

<body>

    <div class="header" style="color: white">
        <table width="100%">
            <tr>
                <td>
                    <h4>
                        <center><a href="booking.php"><img src="images/back.png" height="35px" width="35px"></a></center>
                    </h4>
                </td>
                <td width="20%">
                    <center>
                        <h4>
                            Movie: <?php

                                    echo $movie['movie_name'];
                                    ?>
                        </h4>
                    </center><br>

                </td>
                <td width="20%">
                    <center>
                        <h4>
                            Room: <?php echo $room['room_name'];
                                    ?>
                        </h4>
                    </center>

                </td>

                <td width="20%">
                    <center>
                        <h4>
                            Time: <?php
                                    echo $shw['start_time'];
                                    ?>
                        </h4>
                    </center>
                </td>
                <td width="20%">
                    <center>
                        <h4>Normal Price:
                            <?php
                            echo $room['charge'];
                            ?> 000 <u>đ</u>
                        </h4>
                    </center>
                </td>
                <td width="15%">
                    <center>
                        <h4>VIP Price:
                            <?php
                            echo $room['vip_charge'];
                            ?> 000 <u>đ</u>
                    </center>
                    </h4>
                </td>
            </tr>

        </table>
    </div>
    <div>
        <center>
            <h2> Screen this way</h2>
        </center>
    </div>
    <?php
    $col_seats = 12;
    $row_seats = (int)($room['seats'] / 12);
    $row_vip = (int)($room['vip'] / 12);
    $count_col = 0;
    $count_row = 0; ?>
    <form method="post">
        <div>

            <center>
                <table>
                    <tr>
                        <td></td>
                        <?php
                        for ($count_col = 1; $count_col <= $col_seats; $count_col++) {
                        ?>
                            <td><?php echo $count_col ?></td>
                        <?php
                        }

                        ?>

                    </tr>

                    <?php
                    for ($count_row = 1; $count_row <= $row_seats - $row_vip; $count_row++) {
                    ?>
                        <tr>
                            <td><?php echo chr(ord('A') - 1 + $count_row); ?></td>
                            <?php
                            for ($count_col = 1; $count_col <= $col_seats; $count_col++) {
                                $value = chr(ord('A') - 1 + $count_row) . $count_col;
                            ?>
                                <td>
                                    <input type="checkbox" class="seats" name="a[]" <?php
                                                                                    if (in_array($value, $seats_choosen)) {
                                                                                        echo "checked ";
                                                                                    } else if (in_array($value, $seats_booked)) {
                                                                                        echo "checked ";
                                                                                        echo " disabled";
                                                                                    } ?> value=<?php echo $value ?>>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr class="seatVGap"></tr>
                    <tr>
                        <td style="color:#886D2C">VIP</td>
                    </tr>

                    <?php
                    for ($count_row; $count_row <= $row_seats; $count_row++) {
                    ?>
                        <tr>
                            <td><?php echo chr(ord('A') - 1 + $count_row); ?></td>
                            <?php
                            for ($count_col = 1; $count_col <= $col_seats; $count_col++) {
                                $value = chr(ord('A') - 1 + $count_row) . $count_col;
                            ?>
                                <td>
                                    <input type="checkbox" class="seats" name="a[]" <?php
                                                                                    if (in_array($value, $seats_choosen)) {
                                                                                        echo "checked ";
                                                                                    } else if (in_array($value, $seats_booked)) {
                                                                                        echo "checked ";
                                                                                        echo " disabled";
                                                                                    } ?> value=<?php echo $value ?>>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </center>
        </div>
        <div>
            <center>
                <input type="submit" name='submit_seat' value="Confirm Selection">
            </center>
        </div>
    </form>
    <?php
    if (isset($_POST['submit_seat'])) {
        unset($_SESSION['seatings']);
        unset($_SESSION['amount']);
        $amount = 0;
        foreach ($_POST['a'] as $seat) {
            $tmp = ord(substr($seat, 0, 1)) - ord('A') + 1;
            if ($tmp <= ($row_seats - $row_vip)) {
                $amount = $amount + $room['charge'];
            } else {
                $amount = $amount + $room['vip_charge'];
            }
        }
        if ($amount != 0) {
            $_SESSION['seatings'] = $_POST['a'];
            $_SESSION['amount'] = $amount;
        }
    ?>
        <form>
            <?php
            if ($amount != 0) {
            ?>
                <center>
                    <table>
                        <tr>

                            <th>Number of Seats</th>
                            <th>Seats</th>
                            <th>Amount</th>
                        </tr>
                        <tr>

                            <td>
                                <textarea><?php echo count($_POST['a']); ?></textarea>
                            </td>
                            <td>
                                <textarea><?php foreach ($_POST['a'] as $seat) {

                                                echo $seat . " ";
                                            } ?></textarea>
                            </td>

                            <td>
                                <textarea><?php echo $amount; ?>
							</textarea>
                            </td>

                        </tr>
                </center>
                </table>
            <?php } ?>
            <center><a href="booking.php">Confirm <?php echo $amount; ?></a> </center>
        </form>
    <?php
    }
    ?>
</body>

</html>
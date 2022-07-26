<?php
session_start();
include('../../config.php');
$us = mysqli_query($con, "SELECT s.s_id,s.movie_id,COUNT(t.seat_id) as no_tickets ,SUM(t.price) as tmp_turnover FROM tbl_shows AS s LEFT JOIN tbl_tickets AS t ON t.s_id = s.s_id WHERE ((s.start_date < CURDATE())||((s.start_date = CURDATE())&&(s.end_time < CURRENT_TIME()))) GROUP BY s.s_id");
if (mysqli_num_rows($us)) {
    while ($update = mysqli_fetch_array($us)) {
        if ($update['no_tickets']) {
            $mv = mysqli_query($con, "SELECT tickets, turnover FROM tbl_movie WHERE movie_id='" . $update['movie_id'] . "'");
            $movie = mysqli_fetch_array($mv);
            $tickets = $movie['tickets'] + $update['no_tickets'];
            $turnover = $movie['turnover'] + $update['tmp_turnover'];
            mysqli_query($con, "UPDATE tbl_movie SET tickets = '$tickets',turnover='$turnover' WHERE movie_id ='" . $update['movie_id'] . "'");
        }
        mysqli_query($con, "delete from tbl_shows where s_id='" . $update['s_id'] . "'");
    }
}
$_SESSION['success'] = "Show update successfully";
header("location:view_shows.php");

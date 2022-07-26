<?php
include('header.php');
?>
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Movies List
        </h1>
        <ol class="breadcrumb">
            <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Movies List</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">All Released Movies</h3>
            </div>
            <div class="box-body">
                <?php
                $sw = mysqli_query($con, "SELECT m.movie_id,m.movie_name,m.release_date,m.tickets,m.turnover,COUNT(t.seat_id) as no_bookings ,SUM(t.price) as tmp_turnover FROM tbl_movie AS m left join tbl_shows AS s on m.movie_id=s.movie_id LEFT JOIN tbl_tickets AS t ON t.s_id = s.s_id WHERE m.release_date <= CURDATE() GROUP BY m.movie_id");
                if (mysqli_num_rows($sw)) { ?>
                    <table class="table">
                        <th class="col-md-1">
                            Sl.no
                        </th>
                        <th class="col-md-3">
                            Movie
                        </th>
                        <th class="col-md-2">
                            No.Showdays
                        </th>
                        <th class="col-md-2">
                            No.SoldTickets
                        </th>
                        <th class="col-md-2">
                            Turnover
                        </th>
                        <th></th>
                        <?php
                        $sl = 1;
                        while ($shows = mysqli_fetch_array($sw)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $sl;
                                    $sl++; ?>
                                </td>
                                <td>
                                    <?php echo $shows['movie_name']; ?>
                                </td>
                                <td>
                                    <?php
                                    $datetime1 = new DateTime(date('Y-m-d'));
                                    $datetime2 = new DateTime($shows['release_date']);
                                    $different = $datetime1->diff($datetime2);
                                    echo ($different->m) . ' months, ' . ($different->d) . ' days';
                                    ?>
                                </td>
                                <td>
                                    <?php echo $shows['no_bookings'] + $shows['tickets']; ?>
                                </td>
                                <td>
                                    <?php echo ($turnover = empty($shows['turnover'] + $shows['tmp_turnover']) ? '0' : $shows['turnover'] + $shows['tmp_turnover'] . ' 000'); ?> <u>đ</u>
                                </td>
                                <td>
                                    <div class="tools">
                                        <button class="fa fa-eye" onclick="viewshow(<?php echo $shows['movie_id']; ?>)"></button>
                                        <button class="fa fa-trash-o" onclick="del(<?php echo $shows['movie_id']; ?>)"></button>
                                        <button class="fa fa-edit" onclick="update(<?php echo $shows['movie_id']; ?>)"></button>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                } else {
                ?>
                    <h3>No Shows Added</h3>
                <?php
                }
                ?>
            </div>
            <!-- /.box-footer-->
        </div>
        <br>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">All Waiting Movies</h3>
            </div>
            <div class="box-body">
                <?php
                $sw = mysqli_query($con, "SELECT * FROM tbl_movie  WHERE release_date > CURDATE()");
                if (mysqli_num_rows($sw)) { ?>
                    <table class="table">
                        <th class="col-md-1">
                            Sl.no
                        </th>
                        <th class="col-md-4">
                            Movie
                        </th>
                        <th class="col-md-3">
                            Release Date
                        </th>
                        <th></th>
                        <?php
                        $sl = 1;
                        while ($shows = mysqli_fetch_array($sw)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $sl;
                                    $sl++; ?>
                                </td>
                                <td>
                                    <?php echo $shows['movie_name']; ?>
                                </td>
                                <td>
                                    <?php echo $shows['release_date']
                                    ?>
                                </td>
                                <td>
                                    <div class="tools">
                                        <button class="fa fa-trash-o" onclick="del(<?php echo $shows['movie_id']; ?>)"></button>
                                        <button class="fa fa-edit" onclick="update(<?php echo $shows['movie_id']; ?>)"></button>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                } else {
                ?>
                    <h3>No Shows Added</h3>
                <?php
                }
                ?>
            </div>
            <!-- /.box-footer-->
        </div>
    </section>
    <!-- /.content -->
</div>
<?php
session_start();
if (isset($_SESSION['success'])) {
?>
    <script>
        alert("<?php echo $_SESSION['success']; ?>");
    </script>
<?php
    unset($_SESSION['success']);
}
?>
<?php
include('footer.php');
?>
<script>
    function del(m) {
        if (confirm("Are you want to delete this movie") == true) {
            window.location = "process_delete_movie.php?mid=" + m;
        }
    }
</script>
<script>
    function viewshow(m) {
        window.location = "view_shows.php?mid=" + m;
    }
</script>
<script>
    function update(m) {
        window.location = "update_movie.php?mid=" + m;
    }
</script>
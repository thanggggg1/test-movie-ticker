<?php
include('header.php');
?>
<link rel="stylesheet" href="../../validation/dist/css/bootstrapValidator.css" />

<script type="text/javascript" src="../../validation/dist/js/bootstrapValidator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<?php
include('../../form.php');
$frm = new formBuilder;
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            View Turnover
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">View Turnover</li>
        </ol>
        <br>
        <form action="view_turnover.php" method="get" enctype="multipart/form-data" id="form1">
            <table class="table">
                <tr>
                    <td width=200px>
                        <div class="form-group">
                            <select name="month" class="form-control">
                                <option value>Select Month</option>
                                <option value="<?php echo '0'; ?>"><?php echo 'All'; ?></option>
                                <option value="<?php echo date('m'); ?>"><?php echo 'This Month'; ?></option>
                                <?php

                                for ($month = 1; $month <= 12; $month++) {
                                ?>
                                    <option value="<?php echo $month; ?>"><?php echo date('F', strtotime('01-' . $month . '-2022')); ?></option>
                                <?php
                                }
                                ?>
                            </select>

                        </div>
                    </td>
                    <td width=200px>
                        <div class="form-group">
                            <select name="year" class="form-control">
                                <option value>Select Year</option>
                                <option value="<?php echo date('Y'); ?>"><?php echo 'This Year'; ?></option>
                                <?php

                                for ($year = 2022; $year <= date('Y'); $year++) {
                                ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php $frm->validate("month", array("required", "label" => "Month")); // Validating form using form builder written in form.php 
                        ?>
                    </td>
                    <td>
                        <?php $frm->validate("year", array("required", "label" => "Year")); // Validating form using form builder written in form.php 
                        ?>
                    </td>
                    <td>
                    </td>
                </tr>
            </table>
        </form>
    </section>



    <!--  ===============================================   -->
    <!-- ===============================================   -->
    <!-- M sửa lại chỗ này cho đẹp nhé Thắng -->
    <!--  ===============================================  -->
    <!--  ===============================================  -->
    <!--  ===============================================  -->
    <section class="content">
        <?php if (!isset($_GET['month']) || !isset($_GET['year'])) {
            $tto = mysqli_query($con, "SELECT SUM(amount) as t_amount FROM tbl_bookings WHERE date = CURDATE() GROUP BY date");
            $t_amount = mysqli_fetch_array($tto)['t_amount'];
        ?>
            <div> Today's turnover: <?php echo $today_turnover = empty($t_amount) ? 0 : $t_amount . ' 000'; ?> <u>đ</u></div>
        <?php
            $month = date('m');
            $year = date('Y');
        } else {
            $month = $_GET['month'];
            $year = $_GET['year'];
        }
        $result_array = array();
        $result_key=array();
        if ($month != 0) {
            $mto = mysqli_query($con, "SELECT SUM(amount)as t_amount,date FROM tbl_bookings WHERE MONTH(date) = '$month' AND YEAR(date) = '$year' GROUP BY date ORDER BY date");
            $m_turnover = 0;
            $d_end = date('t', strtotime($year . '-' . $month . '-01'));
            for ($d_count = 1; $d_count <= $d_end; $d_count++) {
                $result_array[date('Y-m-d', strtotime($year . '-' . $month . '-' . $d_count))] = 0;
            }
            while ($m_fetch = mysqli_fetch_array($mto)) {
                $m_turnover += $m_fetch['t_amount'];
                $result_array[$m_fetch['date']] = $m_fetch['t_amount'];
            } ?>
            <div> The month turnover: <?php echo $m_amount = empty($m_turnover) ? 0 : $m_turnover . ' 000'; ?> <u>đ</u></div>
            <table class="table">
                <th class="col-md-2">Day</th>
                <th class="col-md-2">Turnover</th>
            <?php

        } else {
            $y_turnover = 0;
            $yto = mysqli_query($con, "SELECT SUM(amount)as t_amount,date FROM tbl_bookings WHERE YEAR(date) = '$year' GROUP BY date ORDER BY date");
            for ($m_count = 1; $m_count <= 12; $m_count++) {
                $result_array[date('Y-m-t', strtotime($year . '-' . $m_count . '-01'))] = 0;
            }
            while ($y_fetch = mysqli_fetch_array($yto)) {
                $y_turnover += $y_fetch['t_amount'];
                $result_array[date('Y-m-t', strtotime($y_fetch['date']))] += $y_fetch['t_amount'];
            } ?>
                <div style ="font-weight:bold"> The year turnover: <?php echo $y_amount = empty($y_turnover) ? 0 : $y_turnover . ' 000'; ?> <u>đ</u></div>
                <table class="table">
                
                <?php
            }
            foreach ($result_array as $key => $value) {
                ?>
                   <?php array_push($result_key,(empty($month)) ? date('m', strtotime($key))  : date("j", strtotime($key)))?>
                <?php
            }
       
                ?>
                </table>
                <canvas id="myChart" style="width:100%;max-width:900px"></canvas>                
                <script type="text/javascript">
                var xValues = [<?php echo implode(", ",$result_key) ?>]
                var yValues = [<?php echo implode(", ",$result_array) ?>]
                var barColors = [ "green","green","green","green","green","green","green","green","green","green","green","green","green","green","green",
                "green","green","green","green","green","green","green","green","green","green","green","green","green","green","green","green","green","green"
            ,"green","green","green","green","green","green","green","green"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "RHUST Cinema Turn Over"
    }
  }
});
</script>
        
    </section>
</div>
<?php
include('footer.php');
?>
<script>
    <?php $frm->applyvalidations("form1"); ?>
</script>
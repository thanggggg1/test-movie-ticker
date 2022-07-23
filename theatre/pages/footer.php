<!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>&copy; <?php echo date("Y"); ?> <a href="https://github.com/NamHoai1210/MovieTicketBookingSystem.git">RHUST Cinema</a>.</strong>
</footer>

<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->

<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>


</body>

</html>
<style>
    .content {
        padding-bottom: 0px !important;
    }

    #form111 {
        width: 500px;
        margin: 50px auto;
    }

    #search111 {
        padding: 8px 15px;
        background-color: #fff;
        border: 0px solid #dbdbdb;
    }

    #button111 {
        position: relative;
        padding: 6px 15px;
        left: -8px;
        border: 2px solid #ca072b;
        background-color: #ca072b;
        color: #fafafa;
    }

    #button111:hover {
        background-color: #b70929;
        color: white;
    }
</style>
<script src="../../js/auto-complete.js"></script>
<link rel="stylesheet" href="../../css/auto-complete.css">
<script>
    var demo1 = new autoComplete({
        selector: '#search111',
        minChars: 1,
        source: function(term, suggest) {
            term = term.toLowerCase();
            <?php
            $qry2 = mysqli_query($con, "select * from tbl_movie");
            ?>
            var string = "";
            <?php $string = "";
            while ($ss = mysqli_fetch_array($qry2)) {

                $string .= "'" . strtoupper($ss['movie_name']) . "'" . ",";
                //$string=implode(',',$string);


            }
            ?>
            var choices = [<?php echo $string; ?>];
            var suggestions = [];
            for (i = 0; i < choices.length; i++)
                if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
            suggest(suggestions);
        }
    });
</script>
<script>
    var demo2 = new autoComplete({
        selector: '#search222',
        minChars: 1,
        source: function(term, suggest) {
            term = term.toLowerCase();
            <?php
            $qry2 = mysqli_query($con, "select ticket_id from tbl_bookings");
            ?>
            var string = "";
            <?php $string = "";
            while ($ss = mysqli_fetch_array($qry2)) {

                $string .= "'" . strtoupper($ss['ticket_id']) . "'" . ",";
                //$string=implode(',',$string);
            }
            ?>
            var choices = [<?php echo $string; ?>];
            var suggestions = [];
            for (i = 0; i < choices.length; i++)
                if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
            suggest(suggestions);
        }
    });
</script>
<script>
    var demo2 = new autoComplete({
        selector: '#search333',
        minChars: 1,
        source: function(term, suggest) {
            term = term.toLowerCase();
            <?php
            $qry2 = mysqli_query($con, "select email from tbl_users");
            ?>
            var string = "";
            <?php $string = "";
            while ($ss = mysqli_fetch_array($qry2)) {

                $string .= "'" . $ss['email'] . "'" . ",";
                //$string=implode(',',$string);
            }
            ?>
            var choices = [<?php echo $string; ?>];
            var suggestions = [];
            for (i = 0; i < choices.length; i++)
                if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
            suggest(suggestions);
        }
    });
</script>
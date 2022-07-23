<?php
include('header.php');
?>
<!-- =============================================== -->
<?php
if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] == "error") {
?>
        <script>
            alert("Can't find any user!");
        </script>
<?php
    }
    unset($_SESSION['status']);
}
?>
<?php
if (isset($_SESSION['success'])) {
?>
    <script>
        alert("<?php echo $_SESSION['success'] ?>");
    </script>
<?php
    unset($_SESSION['success']);
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">View Users</li>
        </ol>
        <br>
        <div class="block">
            <div class="wrap">

                <form action="process_search_user.php" id="reservation-form" method="get" onsubmit="myFunction()">
                    <fieldset>
                        <div class="field">


                            <input type="text" placeholder="Enter User Email" style="height:30px;width:300px" required id="search333" name="search">

                            <input type="submit" value="Search" style="height:34px;padding-top:3px" id="button111">
                        </div>

                    </fieldset>
                </form>
                <div class="clear"></div>
            </div>
        </div>
        <script>
            function myFunction() {
                if ($('#hero-demo').val() == "") {
                    alert("Please enter user email...");
                    return false;
                } else {
                    return true;
                }
            }
        </script>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        ?>
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of Users</h3>
            </div>
            <div class="box-body">
                <?php
                $year = date('Y');
                if (!isset($_GET['uid'])) {
                    $sw = mysqli_query($con, "SELECT r.user_id,r.name,r.email,r.phone,SUM(b.amount) as total FROM tbl_users as r left join tbl_bookings as b on r.user_id=b.user_id GROUP BY r.user_id");
                } else {
                    $sw = mysqli_query($con, "SELECT r.user_id,r.name,r.email,r.phone,SUM(b.amount) as total FROM tbl_users as r left join tbl_bookings as b on r.user_id=b.user_id WHERE (r.user_id =" . $_GET['uid'] . ") GROUP BY r.user_id");
                }

                if (mysqli_num_rows($sw)) { ?>
                    <table class="table">
                        <th class="col-md-1">
                            Sl.no
                        </th>
                        <th class="col-md-2">
                            User Name
                        </th>
                        <th class="col-md-3">
                            Email
                        </th>
                        <th class="col-md-2">
                            Phone Number
                        </th>
                        <th class="col-md-2">
                            Total Spendings
                        </th>
                        <th class="col-md-1"></th>
                        <?php
                        $sl = 1;
                        while ($user = mysqli_fetch_array($sw)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $sl;
                                    $sl++; ?>
                                </td>
                                <td>
                                    <?php echo $user['name']; ?>
                                </td>
                                <td>
                                    <?php echo $user['email'] ?>
                                </td>
                                <td>
                                    <?php echo $user['phone']; ?>
                                </td>
                                <td>
                                    <?php echo ($total = empty($user['total']) ? '0' : $user['total'] . ' 000'); ?> <u>đ</u>
                                </td>
                                <td>
                                <td width=5%>
                                    <div class="tools">
                                        <button class="fa fa-trash" onclick="del(<?php echo $user['user_id']; ?>)"></button>
                                    </div>
                                </td>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                } else {
                ?>
                    <h3>System has no user</h3>
                <?php
                }
                ?>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<?php
include('footer.php');
?>
<script>
    function del(m) {
        if (confirm("Are you want to delete this user") == true) {
            window.location = "process_delete_user.php?uid=" + m;
        }
    }
</script>
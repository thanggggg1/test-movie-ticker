<?php include('header.php');
if (!isset($_SESSION['user'])) {
    header('location:login.php');
} ?>
<?php
session_start();
extract($_POST);
include('config.php');
$_SESSION['combo_id'] = $combo_id;
$_SESSION['seats'] = substr($seats, 0, strlen($seats) - 1);
$_SESSION['total_amount'] = $amount;
$_SESSION['date'] = $date;
header('location:complete_payment.php');
?>
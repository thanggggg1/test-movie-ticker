<?php include('header.php');
if (!isset($_SESSION['user'])) {
    header('location:login.php');
} ?>
<?php
session_start();
extract($_POST);
include('config.php');
$_SESSION['combo_id'] = $combo_id;
$_SESSION['total_amount'] = $amount;
header('location:complete_payment.php');
?>
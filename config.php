<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db = "moviebookingdb";
$port = 3306;
$con = mysqli_connect($host, $user, $pass, $db, $port) or die('Can\'t not connect to database');

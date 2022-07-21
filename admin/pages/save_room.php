<?php
include('../../config.php');
extract($_POST);
mysqli_query($con, "insert into tbl_rooms values(NULL,'$name','$tid')");

<?php
include'db-connect/config.php';
if (!isset($_SESSION)) {
    session_start();
}

$user_id = $_SESSION['user_id'] ;
 


$update_userlog = "UPDATE user_log SET log_out_time = NOW() WHERE user_id = '$user_id'";
$update_userlog_p = mysql_query($update_userlog);

session_unset();
session_destroy();
header("location:../../index.php");


?>

<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\Login\Login;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
if(!isset($_SESSION)) {
	session_start();
}


$login = new Login();

$row = $login->prepare($_POST)->logininfo();


	if ($row == true) {
		if($row['status']==0)
		{
			echo "<script language= 'JavaScript'>alert('You are on pending for accept.. !');</script>";
			echo '<script> location.replace("Signup.php"); </script>';
		}

        $_SESSION['id']			=$row['id'];
		$_SESSION['user_id'] 	=$row['user_id'];
		$_SESSION['email']  	=$row['email'];
		$_SESSION['role']  	=$row['role'];
		$_SESSION['status']		=$row['status'];
		$_SESSION['district']	=$row['district_cd'];



		$insert_userlog_p = "";
		$update_userlog_p = "";


			switch ($_SESSION['role']) {
				case "1":
						echo '<script> location.replace("dashboard.php"); </script>';
						break;
				case "2":
						echo '<script> location.replace("dashboard.php"); </script>';
						break;
				case "3":
						echo '<script> location.replace("dashboard.php"); </script>';
						break;
				default:
						echo "<script language= 'JavaScript'>alert('Authendication Failed !');</script>";
						echo '<script> location.replace("Signup.php"); </script>';
			}

} else {
    echo "<script language= 'JavaScript'>alert('Your Username Or password Wrong !');</script>";
    echo '<script> location.replace("Signup.php"); </script>';
}
?>
<?php include 'session.php'; ?>
<?php include'wear_connect/config.php';  ?>
<?php
$id = $_SESSION['user_id'];
if ($_SESSION['level'] == 1) {
	$admin_balance = mysql_query("SELECT id,user_name,user_email,Password,user_contact,role,profile_pic FROM ratul_login  WHERE id='$id' and role=1");
	while ($data = mysql_fetch_row($admin_balance)) {
		$id = $data['0'];
		$usernamee=$data['1'];
		$email=$data['2'];
		$password=$data['3'];
		$level=$data['5'];
		$role="Admin";
	}
} 
elseif($_SESSION['level'] == 2) {
	$admin_balance = mysql_query("SELECT id,user_name,user_email,Password,user_contact,role,profile_pic FROM ratul_login  WHERE id='$id' and role=2");
	while ($data = mysql_fetch_row($admin_balance)) {
		$id = $data['0'];
		$usernamee=$data['1'];
		$email=$data['2'];
		$password=$data['3'];
		$level=$data['5'];
		$rpic=$data['6'];
		$role="Customer";
	}
}
elseif($_SESSION['level'] == 3) {
	$admin_balance = mysql_query("SELECT id,user_name,user_email,Password,user_contact,role,profile_pic FROM ratul_login  WHERE id='$id' and role=3");
	while ($data = mysql_fetch_row($admin_balance)) {
		$id = $data['0'];
		$usernamee=$data['1'];
		$email=$data['2'];
		$password=$data['3'];
		$level=$data['5'];
		$rpic=$data['6'];
		$role="House"; 
	}
}
elseif($_SESSION['level'] == 5) {
	$admin_balance = mysql_query("SELECT id,user_name,user_email,Password,user_contact,role,profile_pic FROM ratul_login  WHERE id='$id' and role=5");
	while ($data = mysql_fetch_row($admin_balance)) {
		$id = $data['0'];
		$usernamee=$data['1'];
		$email=$data['2'];
		$password=$data['3'];
		$level=$data['5'];
		$role="Sub-Admin"; 
	}
}
?>
                    
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <title>Connect Share System</title>

  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">
  <link rel="stylesheet" href="./css/font-awesome.min.css">
  <link rel="stylesheet" href="./js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./js/plugins/select2/select2.css">
  <!-- <link rel="stylesheet" href="./js/plugins/datepicker/datepicker.css">
  <link rel="stylesheet" href="public/default.css" type="text/css">-->
  <link rel="stylesheet" href="public/style.css" type="text/css">
  <link rel="stylesheet" href="public/my-button.css" type="text/css">
  <link rel="stylesheet" href="public/my-css-style.css" type="text/css">
  <!-- Plugin CSS -->
  <link rel="stylesheet" href="./js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css">
  <link rel="stylesheet" href="./js/plugins/magnific/magnific-popup.css">
  
   <link rel="stylesheet" href="./js/plugins/morris/morris.css">
  <link rel="stylesheet" href="./js/plugins/icheck/skins/minimal/blue.css">
  <link rel="stylesheet" href="./js/plugins/select2/select2.css">
  <!-- <link rel="stylesheet" href="./js/plugins/fullcalendar/fullcalendar.css">-->

  <!-- App CSS -->
  <link rel="stylesheet" href="./css/target-admin.css">
  <!-- <link rel="stylesheet" href="./css/custom.css">-->

  <!-- Page CSS -->
  <link rel="stylesheet" href="./css/demos/ui-notifications.css">
  <!-- datatable -->
  
    <!-- <link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="media/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="media/css/uikit.min.css" />
    <link rel="stylesheet" type="text/css" href="media/css/dataTables.uikit.min.css" />
  
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>
<body>
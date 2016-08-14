<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

//use App\Bitm\Model\Database as DB;
use App\Bitm\Header\Header;
//use App\Bitm\Login\Login;

//session_start();
include 'session.php'; 
if (!isset($_SESSION['user_id'])) {
    header("Location:Signup.php");
}
$id= $_SESSION['id'];
$userid=$_SESSION['user_id'];
$email=$_SESSION['email'];
$role=$_SESSION['role'];
$status=$_SESSION['status'];
$district=$_SESSION['district'];



use App\Bitm\Visitor_Message\Vmessage;
$cMessage=new Vmessage();
$vMessage=$cMessage->count_message();



?>
<br>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <title>NECI</title>

  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
	<link href="./img/aam-logo.png" rel="shortcut icon">
	
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">
  <link rel="stylesheet" href="./css/font-awesome.min.css"> 
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="./js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./js/plugins/select2/select2.css">
  <link rel="stylesheet" href="./js/plugins/datepicker/datepicker.css">
  <link rel="stylesheet" href="public/default.css" type="text/css">
  <link rel="stylesheet" href="public/style.css" type="text/css">
  <link rel="stylesheet" href="public/my-button.css" type="text/css">
  <link rel="stylesheet" href="public/my-css-style.css" type="text/css">
  
  <!-- Plugin CSS -->
  <link rel="stylesheet" href="./js/plugins/morris/morris.css">
  <link rel="stylesheet" href="./js/plugins/icheck/skins/minimal/blue.css">
  <link rel="stylesheet" href="./js/plugins/select2/select2.css">
  <link rel="stylesheet" href="./js/plugins/fullcalendar/fullcalendar.css">

  <link rel="stylesheet" href="./js/plugins/simplecolorpicker/jquery.simplecolorpicker.css">
  <link rel="stylesheet" href="./js/plugins/timepicker/bootstrap-timepicker.css">
  <!-- App CSS -->
  <link rel="stylesheet" href="./css/target-admin.css">
	
</head>
<body>

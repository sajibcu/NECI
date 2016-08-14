<?php

include 'session.php';
if (!isset($_SESSION['user_id'])) {
    header("Location:Signup.php");
}
include'db-connect/config.php';

$id = $_SESSION['user_id'];
if ($_SESSION['role'] == 1) {
    $admin_balance = mysqli_query("SELECT id,user_id,email,password,phone_no,image,role,district_cd,status FROM user_info  WHERE user_id='$id' and role=1");

    while ($data = mysqli_fetch_row($admin_balance)) {
        $id=$data['0'];
        $user_id=$data['1'];
        $email=$data['2'];
        $password=$data['3'];
        $phone_no=$data['4'];
        $img=$data['5'];
        $role=$data['6'];
        $dis_cd=$data['7'];
        $role="Admin";

    }

}
elseif($_SESSION['role'] == 2) {
    $admin_balance = mysqli_query("SELECT id,user_id,email,password,phone_no,image,role,district_cd,status FROM user_info WHERE user_id='$id' and role=2");

    while ($data = mysqli_fetch_row($admin_balance)) {
        $id=$data['0'];
        $user_id=$data['1'];
        $email=$data['2'];
        $password=$data['3'];
        $phone_no=$data['4'];
        $img=$data['5'];
        $role=$data['6'];
        $dis_cd=$data['7'];
        $role="User";

    }

}

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title><?php echo $ins_full_nm;?></title>

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



    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="../../Resources/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Resources/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../Resources/assets/css/form-elements.css">
    <!--
    <link rel="stylesheet" href="../../Resources/assets/css/style.css">-->


    <link href="../../neci/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../../Resources/assets/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="../../Resources/assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../Resources/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../Resources/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../Resources/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../../Resources/assets/ico/apple-touch-icon-57-precomposed.png">


</head>
<body>
<?php
include_once('../../vendor/autoload.php');
if(isset($_SESSION)) {
    session_start();
}


use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\User\Auth;
use  App\Bitm\User\User;


//use App\Model\Database as DB;




$auth= new Auth();
$status= $auth->prepare($_POST)->is_loggedin();

//if($status== FALSE){
////    Message::message("<div class=\"alert alert-success\">
////  <strong>Hey!</strong>You have to log in before view this page
////</div>");
//////    return Utility::redirect('../index.php');
//    echo  "sucsesfully enter";
//
//}
$city=new User();
$alcity=$city->getcity();

?>
<div id="message">

    <?php if((array_key_exists('message',$_SESSION)&& !empty($_SESSION['message']))){
        echo Message::message();
    }?>
</div>
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
<div class="header">
    
    <div class="top-content">

        <div class="inner-bg">
            <div class="row">

                <div  class="col-sm-1 middle-border"></div>
                <div class="col-sm-1"></div>

                <div class="col-sm-6">

                    <div   class="form-box"  >
                        <div class="form-top" >
                            <div class="form-top-left">
                                <h3>Add New Admin</h3>
                                <p>Fill in the form below to get instant access:</p>
                            </div>
                            <div class="form-top-right">
                                <!-- <i class="fa fa-pencil"></i> -->
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form role="form" action="StoreNewAdmin.php" method="post" class="registration-form">
                                <!--                                <div class="form-group">-->
                                <!--                                    <label class="sr-only" for="form-first-name">First name</label>-->
                                <!--                                    <input type="text" required name="first_name" placeholder="First name..." class="form-email form-control" id="form-email">-->
                                <!--                                </div>-->
                                <!--                                <div class="form-group">-->
                                <!--                                    <label class="sr-only" for="form-last-name">Last name</label>-->
                                <!--                                    <input type="text" required name="last_name" placeholder="Last name..." class="form-email form-control" id="form-email">-->
                                <!--                                </div>-->
                                <div class="form-group">
                                    <label class="sr-only" for="form-user_id">User Id</label>
                                    <input type="text" required name="user_id" placeholder="User Id..." class="form-email form-control" id="form-email">
                                </div>


                                <div class="form-group">
                                    <label class="sr-only" for="form-email">Email</label>
                                    <input type="email" required name="email" placeholder=" Email..." class="form-email form-control" id="form-email">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-email">Password</label>
                                    <input type="password" required name="password" placeholder="Enter password" class="form-email form-control" id="form-email">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-email">Phone</label>
                                    <input type="text" name="phone" placeholder=" phone..." class="form-email form-control" id="form-email">
                                </div>
                                <input name="role" value="1" type="hidden">

                                <div class="form-group">
                                    <label class="sr-only" for="form-email">Phone</label>
                                    <select  type="text" name="city" class="form-email form-control" id="form-email" required>
                                        <option selected>Select Your City</option>
                                        <?php
                                        $i=0;
                                        foreach ($alcity as $city){
                                            echo "<option value=\"".$city['district_cd']."\">".$city['district_name']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>


                                <!--                                <select  name="city" required>-->
                                <!--                                    <option style="display: none">select</option>-->
                                <!--                                    php-->
                                <!--                                    $i=0;-->
                                <!--                                    foreach ($alcity as $city){-->
                                <!--                                        echo "<option value=\"".$city['district_cd']."\">".$city['district_name']."</option>";-->
                                <!--                                    }-->

                                <!--                                </select>-->

                                <button type="submit" class="btn btn-xl">Add new Admin!</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>


<!-- Javascript -->
<script src="../../Resources/assets/js/jquery-1.11.1.min.js"></script>
<script src="../../Resources/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../../Resources/assets/js/jquery.backstretch.min.js"></script>
<script src="../../Resources/assets/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="../../Resources/assets/js/placeholder.js"></script>
<script>
    $('#message').show().delay(3000).fadeOut();
</script>
<![endif]-->

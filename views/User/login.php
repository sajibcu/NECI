<?php
namespace  App\Bitm\User;
include_once('../../vendor/autoload.php');
session_start();



use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\User\Auth;


//use App\Model\Database as DB;










$auth= new Auth();
//Utility::dd($_POST);
$status= $auth->prepare($_POST)->is_registered();

if($status){
    $_SESSION['user_neci']=$_POST['email'];
    echo "successfully login";

}else{
    Message::message("<div class=\"alert alert-success\">
  <strong>UnSuccess!</strong> Please check your email or password
</div>");
    Utility::redirect('Signup.php');
}
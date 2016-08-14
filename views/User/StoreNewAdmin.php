<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;
use App\Bitm\User\User;
use App\Bitm\User\Auth;

$user=new User();
$auth= new Auth();
//Utility::dd($_POST);
$status= $auth->prepare($_POST)->is_exist();

if($status){
    Message::message("<div class=\"alert alert-danger\">
  <strong>Unsuccess!</strong> Email you entered are already taken, plz try to login
</div>");
    Utility::redirect('CreateNewAdmin.php');

}
else {
    $user->prepare($_POST);
    $user->store();
}

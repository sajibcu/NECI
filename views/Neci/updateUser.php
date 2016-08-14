<?php
include_once('../../vendor/autoload.php');
use App\Bitm\User\userApproval;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

$user= new userApproval();
$user->prepare($_GET)->update();
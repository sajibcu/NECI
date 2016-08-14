<?php
include_once('../../vendor/autoload.php');
use App\Bitm\User\userApproval;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

$data= new userApproval();
$data->prepare($_GET)->delete_admin();

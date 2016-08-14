<?php
include_once('../../vendor/autoload.php');
use App\Bitm\District\District;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

$book= new District();
$book->prepare($_POST)->update();
//Utility::dd($book);
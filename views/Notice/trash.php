<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\District\District;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;


$book= new District();
$book->prepare($_GET)->trash();
<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\District\District;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

$data = new District();
$data->prepare($_GET)->recover();
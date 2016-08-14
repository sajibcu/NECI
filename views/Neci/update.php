<?php
include_once('../../vendor/autoload.php');
use App\Bitm\Neci\Neci;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

$book= new Neci();
$book->prepare($_POST)->update();
<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\Neci\Neci;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;


$book= new Neci();
$book->prepare($_GET)->trash();
<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\Neci\Neci;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;


//Utility::d($_POST['mark']);.

$book= new Neci();
$book->recoverMultiple($_POST['mark']);
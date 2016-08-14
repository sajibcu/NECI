<?php
include_once('../../vendor/autoload.php');
use App\Bitm\Neci\Neci;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

$data= new Neci();
//Utility::dd($book);
//die();
$data->prepare($_GET)->delete();



<?php
include_once('../../vendor/autoload.php');
use App\Bitm\Notice\Notice;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

$data= new Notice();
//Utility::dd($book);
//die();
$data->prepare($_GET)->delete();



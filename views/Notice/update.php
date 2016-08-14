<?php
include_once('../../vendor/autoload.php');
use App\Bitm\Notice\Notice;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

$book= new Notice();
//Utility::dd($_POST);
$book->prepare($_POST)->update();
//Utility::dd($book);
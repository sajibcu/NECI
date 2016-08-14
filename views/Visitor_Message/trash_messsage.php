<?php
if(!isset($_SESSION)) {
    session_start();
}
include_once('../../vendor/autoload.php.');
use App\Bitm\Visitor_Message\Vmessage;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;

$book= new Vmessage();
//Utility::dd($_GET);
$book->prepare($_GET)->volt();
?>
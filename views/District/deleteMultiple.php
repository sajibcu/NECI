
<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\District\District;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;


//Utility::d($_POST['mark']);.

$book= new District();
$book->deleteMultiple($_POST['mark']);
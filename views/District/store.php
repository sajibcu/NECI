<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\District\District;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;


if((isset($_POST['district_name']))&& (!empty($_POST['district_name']))) {
    $data = new District();
    $data->prepare($_POST);
   //Utility::dd($data);
   //die();
    $data->store_district_details();

}
else {
    echo "Please insert some data";
}
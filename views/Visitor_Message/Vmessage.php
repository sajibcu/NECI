<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\Visitor_Message\Vmessage;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\Model\Database;


$vmessage= new Vmessage();
//Utility::dd($_POST);
$nmessage=$vmessage->prepare($_POST)->store_vmessage_details();


//if((isset($_POST['district_cd']))&& (!empty($_POST['district_cd']))) {
//    if((isset($_POST['visitor_name']))&& (!empty($_POST['visitor_name']))) {
//        if((isset($_POST['visitor_email']))&& (!empty($_POST['visitor_email']))) {
//            if((isset($_POST['visitor_phone']))&& (!empty($_POST['visitor_phone']))) {
//                if((isset($_POST['visitor_message']))&& (!empty($_POST['visitor_message']))) {
//
//                    $nmessage=$vmessage->prepare($_POST)->store_vmessage_details();
//
//                }
//            }
//        }
//    }
//}
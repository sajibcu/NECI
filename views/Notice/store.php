<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\Notice\Notice;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

if((isset($_POST['notice_title']))&& (!empty($_POST['notice_title']))) {
    if((isset($_POST['notice_title']))&& (!empty($_POST['notice_title']))) {

        $data = new Notice();
        $data->prepare($_POST)->store_notice_details();
        //Utility::dd($data);
        //die();

        
    }
}
else {
    echo "Please insert some data";
}
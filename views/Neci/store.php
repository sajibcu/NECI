<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\Neci\Neci;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;


//if((isset($_POST['unit']))&& (!empty($_POST['unit']))) {
//    $data = new Neci();
//    $data->prepare($_POST);
//   //Utility::dd($data);
//   //die();
//    $data->store_consume_details();
//
//}
//else {
//    echo "Please insert some data";
//}

$data = new Neci();

if((isset($_POST['unit']))&& (!empty($_POST['unit']))) {
    $status = $data->prepare($_POST)->is_exist();
//        Utility::dd($_POST);
//         die();
    if ($status) {
        Message::message("<div class=\"alert alert-danger\">
              <strong>Unsuccess!</strong> Data you entered are already taken, plz try to another day
            </div>");
        Utility::redirect('../../views/User/add_consumption.php');
      
    } else {
        $data->prepare($_POST);
        $data->store_consume_details();
    }
}


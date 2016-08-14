<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\User\User;
$user=new User();
if((isset($_FILES['image'])) && (!empty($_FILES['image']['name']))) {
    $imageName = time() . $_FILES['image']['name'];
    $temporary_location = $_FILES['image']['tmp_name'];
    //unlink($_SERVER['DOCUMENT_ROOT'] . '/27072016/final_project/resources/images/' . $singleInfo['image']);
    move_uploaded_file($temporary_location, '../../Resources/img' . $imageName);
    $_POST['image'] = $imageName;
    
}
$result=$user->update($_POST);
if($result){
    Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong> Sucessfully Updated your profile
</div>");
    //Utility::dd($_POST);
    Utility::redirect('dashboard.php');

} else {
    Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has not been Updated successfully.
    </div>");
    Utility::redirect('dashboard.php');

}
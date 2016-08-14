<?php
namespace  App\Bitm\User;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\Model\Database as DB;
class UserProfile{
    public  $id="";
    public  $first_name="";
    public  $last_name="";
    public  $email="";
    public  $phone="";
    public  $password="";
    public  $city="";
    public  $conn;

    public function prepare($data){
        if(array_key_exists("id",$data)){
            $this->id= $data['id'];
        }
        if(array_key_exists("first_name",$data)){
            $this->first_name= filter_var($data['first_name'], FILTER_SANITIZE_STRING);
        }
        if(array_key_exists("last_name",$data)){
            $this->last_name= filter_var($data['last_name'], FILTER_SANITIZE_STRING);
        }
//        if(array_key_exists("first_name",$data)){
//            $this->first_name= filter_var($data['first_name'], FILTER_SANITIZE_STRING);
//        }
//        if(array_key_exists("last_name",$data)){
//            $this->last_name= filter_var($data['last_name'], FILTER_SANITIZE_STRING);
//        }

        if(array_key_exists("password",$data)){
            $this->password=md5($data['password']);
        }
        if(array_key_exists("designation",$data)){
            $this->designation= filter_var($data['designation'], FILTER_SANITIZE_STRING);
        }

        if(array_key_exists("city",$data)){
            $this->city= $data['city'];
        }
        //return $this;
    }
////Prepare Connection
    public function __construct()
    {
        $this->conn=mysqli_connect("localhost","root","","neci") or die('Database connection failed');
    }




    public function store(){
        $query="INSERT INTO `neci`.`user_profile` (`user_id`, `email`,`phone_no`, `password`, `district_cd`, `role`,`signup_date`,`signup_time`) 
    VALUES ('".$this->user_id."', '".$this->email."', '".$this->phone."','".$this->password."','".$this->city."','2',now(),now())";
        $result=mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong> Sucessfully Registered, you can log in now.
</div>");
            Utility::redirect('Signup.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has not been stored successfully.
    </div>");
            Utility::redirect('Signup.php');

        }
    }
/////////////////////update user profile
    public function update(){
        $query="UPDATE `neci`.`user_profile` SET `first_name` = '".$this->first_name."',`last_name` = '".$this->last_name."' 
             WHERE `district_info`.`id` =".$this->id;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-info\">
            <strong>Updated!</strong> Data has been Updated successfully.
            </div>");
            header('Location:index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
            <strong>Error!</strong> Data has not been updated  successfully.
            </div>");
            Utility::redirect('index.php');

        }

    }







//////////////////////////////////////////////
    public  function getcity()
    {
        $query="SELECT * FROM `district_info` WHERE `deleted_at` IS NULL";
        // Utility::dd()
        $result=mysqli_query($this->conn,$query);
        $alcity=array();

        while ($row=mysqli_fetch_assoc($result))
        {
            $alcity[]=$row;
        }

        return $alcity;
    }




}







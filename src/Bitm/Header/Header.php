<?php
namespace  App\Bitm\Header;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
//use App\Bitm\Model\Database as DB;


class Header{
    public  $id="";
    public  $email="";
    public  $password="";
    public  $conn;

    public function prepare($data){
        if(array_key_exists("id",$data)){
            $this->id= $data['id'];
        }
        if(array_key_exists("email",$data)){
            $this->email= filter_var($data['email'], FILTER_SANITIZE_STRING);
        }
//        if(array_key_exists("password",$data)){
//            $this->password= filter_var($data['password'], FILTER_SANITIZE_STRING);
//        }
//        if(array_key_exists("first_name",$data)){
//            $this->first_name= filter_var($data['first_name'], FILTER_SANITIZE_STRING);
//        }
//        if(array_key_exists("last_name",$data)){
//            $this->last_name= filter_var($data['last_name'], FILTER_SANITIZE_STRING);
//        }

        if(array_key_exists("password",$data)){
            $this->password= md5($data['password']);
        }
//        if(array_key_exists("phone",$data)){
//            $this->phone= filter_var($data['phone'], FILTER_SANITIZE_STRING);
//        }

//        if(array_key_exists("city",$data)){
//            $this->city= $data['city'];
//        }
        return $this;
    }
//Prepare Connection
    public function __construct()
    {
        $this->conn=mysqli_connect("localhost","root","","neci") or die('Database connection failed');
    }




    public function store(){
        $query="INSERT INTO `neci`.`user_info` (`user_id`, `email`,`phone_no`, `password`, `district_cd`, `role`,`signup_date`,`signup_time`) 
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



    public function headerinfo()
    {
        $query = "SELECT id,user_id,email,password,phone_no,image,role,district_cd,status  FROM `user_info`   WHERE `email`='".$this->email."'  AND `password`='".$this->password."'";//'".$this->password."'  AND `password`='1'
        //echo $query;
        //die();
        $result = mysqli_query($this->conn, $query);
        //$row=mysqli_fetch_assoc($result);
        $row = mysqli_num_rows($result);
//    Utility::dd($row);
//      die();
        if ($row > 0) {
            $row1=mysqli_fetch_assoc($result);
            return $row1;
        } else {
            return false;
        }
    }




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







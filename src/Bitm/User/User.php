<?php
namespace  App\Bitm\User;

if(!isset($_SESSION))
{
    session_start();
}
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\Model\Database as DB;


class User extends DB{
    public  $id="";
    public  $first_name="";
    public  $last_name="";
    public  $email="";
    public  $phone="";
    public  $password="";
    public  $city="";
    public  $designation="";
    public  $conn;
    public  $role=2;

    public function prepare($data){
        if(array_key_exists("id",$data)){
            $this->id= $data['id'];
        }
        if(array_key_exists("role",$data)){
            $this->role= $data['role'];
        }

        if(array_key_exists("user_id",$data)){
            $this->user_id= filter_var($data['user_id'], FILTER_SANITIZE_STRING);
        }
        if(array_key_exists("email",$data)){
            $this->email= filter_var($data['email'], FILTER_SANITIZE_STRING);
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
        if(array_key_exists("phone",$data)){
            $this->phone= filter_var($data['phone'], FILTER_SANITIZE_STRING);
        }

        if(array_key_exists("city",$data)){
            $this->city= $data['city'];
        }

        if(array_key_exists("designation",$data)){
            $this->designation= filter_var($data['designation'], FILTER_SANITIZE_STRING);
        }

        //return $this;
    }
////Prepare Connection
//    public function __construct()
//    {
//        $this->conn=mysqli_connect("localhost","root","","neci") or die('Database connection failed');
//    }




public function store(){
    $query="INSERT INTO `neci`.`user_info` (`user_id`, `email`,`phone_no`, `password`, `district_cd`, `role`,`signup_date`,`signup_time`) 
    VALUES ('".$this->user_id."', '".$this->email."', '".$this->phone."','".$this->password."','".$this->city."','".$this->role."',now(),now())";
    $result=mysqli_query($this->conn,$query);
    if($result){
        Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong> Sucessfully Registered, you can log in now.
</div>");
        if($this->role==2) {
            Utility::redirect('Signup.php');
        }
        else
        {
            Utility::redirect('../../views/User/CreateNewAdmin.php');
        }

    } else {
        Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has not been stored successfully.
    </div>");
        if($this->role==2) {
            Utility::redirect('Signup.php');
        }
        else
        {
            Utility::redirect('../../views/User/CreateNewAdmin.php');
        }

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

    public  function getInfo()
    {
        $query="SELECT * FROM `user_info` WHERE `email`='".$this->email."'";
        $result=mysqli_query($this->conn,$query);
        $row=mysqli_fetch_assoc($result);
        return $row;

    }

    public  function update($data)
    {
        $email=$_SESSION['email'];
       // Utility::dd($data);
        //$data['image'].=time();
        $query="UPDATE `user_info` SET `first_name`='".$data['first_name']."',`last_name`='".$data['last_name']."',`district_cd`='".$data['city']."',
        `phone_no`='".$data['phone_no']."',`designation`='".$data['designation']."' WHERE `email`='".$email."'";
        //Utility::dd($query);
        $result=mysqli_query($this->conn,$query);
        if($result){
            $_SESSION['district']=$data['city'];
            return TRUE;

        } else {
            return FALSE;

        }
    }




}







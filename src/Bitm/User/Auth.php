<?php

namespace  App\Bitm\User;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;


use App\Bitm\Model\Database as DB;



class Auth extends DB{
    public $email="";
    public $password="";
    public function __construct()
    {
        parent::__construct();
    }
    public  function prepare($data=Array()){

        if(array_key_exists('email',$data)){
            $this->email= $data['email'];
        }
        if(array_key_exists('password',$data)){
            $this->password= md5($data['password']);
        }

        return $this;

    }




    public function is_exist(){
        $query="SELECT * FROM `user_info` WHERE `email`='".$this->email."'";
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_num_rows($result);
        //Utility::dd($row);
        if($row>0){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    public function is_registered(){
        $query="SELECT * FROM `user_info` WHERE `email`='".$this->email."' AND `password`='".$this->password."'";
        //echo $query;
        //die();
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_num_rows($result);
        if($row>0){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    public function logout()
    {
        if ((array_key_exists('user_neci', $_SESSION)) && (!empty($_SESSION['user_neci']))) {
            $_SESSION['user_neci'] = "";
            return TRUE;
        }

    }
    public function is_loggedin(){
        if((array_key_exists('user_neci',$_SESSION))&& (!empty($_SESSION['user_neci']))){
            return TRUE;
        }
        else{
            return FALSE;
        }

    }


}



<?php
namespace  App\Bitm\Neci;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\Model\Database as DB;
class Neci extends DB{
    //Variable Declare
    public $id="";
    public $district_cd="";
    public $user_id="";
    public $input_date="";
    public $input_time="";
    public $unit="";
    public $conn;
    public $deleted_at;

///Prepare the data
    public function prepare($data=Array()){
        if(array_key_exists("district_cd",$data)){
            $this->district_cd= $data['district_cd'];
        }
        if(array_key_exists("user_id",$data)){
            $this->user_id= filter_var($data['user_id'], FILTER_SANITIZE_STRING);
        }
        if(array_key_exists("input_date",$data)){
            $this->input_date= $data['input_date'];
        }
        if(array_key_exists("input_time",$data)){
            $this->input_time= $data['input_time'];
        }

        if(array_key_exists("unit",$data)){
            $this->unit= filter_var($data['unit'], FILTER_SANITIZE_STRING);
        }
        if(array_key_exists("id",$data)){
            $this->id= $data['id'];
        }
        return $this;
    }
////Prepare Connection
//    public function __construct()
//    {
//        $this->conn= mysqli_connect("localhost","root","","neci") or die("Database connection failed");
//    }

///////////////////verify existing data



        public function is_exist(){
            $query="SELECT * FROM `neci`.`consume_details` WHERE `input_date`='".$this->input_date."' AND `district_cd`='".$this->district_cd."'";
            $result= mysqli_query($this->conn,$query);
            $row= mysqli_num_rows($result);
//            echo $row;
//            die();
            if($row>0){
                return TRUE;
            }
            else {
                return FALSE;
            }
        }



////Storeing Data
    public function store_consume_details(){
        $query="INSERT INTO `neci`.`consume_details` (`district_cd`, `user_id`, `input_date`, `input_time`, `unit`) 
                VALUES ('".$this->district_cd. "','".$this->user_id."','".$this->input_date."',Now(),'".$this->unit."')";
        echo $query;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
                                    <strong>Success!</strong> Data has been stored successfully.
                                    </div>");
            header('Location:../../views/User/dashboard.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
                                    <strong>Error!</strong> Data has not been stored successfully.
                                    </div>");
            Utility::redirect('../../views/User/add_consumption.php');
        }
    }
/////Display Data All  without trash
    public function index(){
        $_allData= array();
        $query="SELECT * FROM `neci`.`consume_details` WHERE `deleted_at` IS NULL";
        $result= mysqli_query($this->conn,$query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while($row= mysqli_fetch_assoc($result)){
            $_allData[]=$row;
        }
        return $_allData;
    }

/////View Data
    public function view(){
        $query="SELECT * FROM `neci`.`consume_details` WHERE `id`=".$this->id;
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row;
    }

/////Update  Single Data
    public function update(){
        $query="UPDATE `neci`.`consume_details` SET `unit` = '".$this->unit."' 
             WHERE `consume_details`.`id` =".$this->id;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-info\">
            <strong>Updated!</strong> Data has been Updated successfully.
            </div>");
            header('Location:../../views/User/dashboard.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
            <strong>Error!</strong> Data has not been updated  successfully.
            </div>");
            Utility::redirect('../../views/User/dashboard.php');

        }

    }
////Delete Single Data
    public function delete(){
        $query="DELETE FROM `neci`.`consume_details` WHERE `consume_details`.`id` = ".$this->id;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
            <strong>Deleted!</strong> Data has been deleted successfully.
            </div>");
            header('Location:../../views/User/dashboard.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
            <strong>Error!</strong> Data has not been deleted successfully.
            </div>");
            Utility::redirect('Location:../../views/User/dashboard.php');
        }
    }
//////////trash temporary
    public function trash(){
        $this->deleted_at=time();
        $query="UPDATE `neci`.`consume_details` SET `deleted_at` = '".$this->deleted_at."' WHERE `consume_details`.`id` = ".$this->id;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
            <strong>Trashed!</strong> Data has been trashed successfully.
            </div>");
            header('Location:index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
            <strong>Error!</strong> Data has not been trashed successfully.
            </div>");
            Utility::redirect('index.php');
        }
    }

//////////trash temporary list
    public function trashed(){
        $_trashedBook= array();
        $query="SELECT * FROM `neci`.`consume_details` WHERE `deleted_at` IS NOT NULL";
        $result= mysqli_query($this->conn,$query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while($row= mysqli_fetch_assoc($result)){
            $_trashedBook[]=$row;
        }

        return $_trashedBook;

    }
    /////trashcount
    public function trashedcount(){
        $query="SELECT count(*) AS tcount FROM `neci`.`consume_details` WHERE `deleted_at` IS NOT NULL";
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['tcount'];

    }

//////////recover single
    public function recover(){
        $query="UPDATE `neci`.`consume_details` SET `deleted_at` = NULL  WHERE `id` = ".$this->id;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
  <strong>Recovered!</strong> Data has been recovered successfully.
</div>");
            header('Location:index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has not been recovered successfully.
    </div>");
            Utility::redirect('index.php');

        }

    }



//////////recover multiple
    public function recoverMultiple($idS=array()){
        if((is_array($idS)) && count($idS)>0){
            $IDs= implode(",",$idS);
            $query="UPDATE `neci`.`consume_details` SET `deleted_at` = NULL  WHERE `consume_details`.`id` IN(".$IDs.")";
            //result= mysqli_query($this->conn,$query);
            $result= mysqli_query($this->conn,$query);
            if($result){
                Message::message("<div class=\"alert alert-success\">
  <strong>Recovered!</strong> Selected Data has been recovered successfully.
</div>");
                header('Location:index.php');

            } else {
                Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Selected Data has not been recovered successfully.
    </div>");
                Utility::redirect('index.php');

            }



        }

    }

//////////delete multiple
    public function deleteMultiple($idS=array()){
        if((is_array($idS)) && count($idS)>0){
            $IDs= implode(",",$idS);
            $query="DELETE FROM `neci`.`consume_details`  WHERE `consume_details`.`id` IN(".$IDs.")";
            //result= mysqli_query($this->conn,$query);
            $result= mysqli_query($this->conn,$query);
            if($result){
                Message::message("<div class=\"alert alert-success\">
  <strong>Recovered!</strong> Selected Data has been Deleted successfully.
</div>");
                header('Location:index.php');

            } else {
                Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Selected Data has not been Deleted successfully.
    </div>");
                Utility::redirect('index.php');

            }
        }
    }

///////////////////////count
    public function count(){
        if ($_SESSION['role']==1) {
            $query = "SELECT COUNT(*) AS totalItem FROM `neci`.`consume_details` WHERE `deleted_at` IS NULL";
            $result = mysqli_query($this->conn, $query);
            $row = mysqli_fetch_assoc($result);
            return $row['totalItem'];
        }else{
            $query = "SELECT COUNT(*) AS totalItem FROM `neci`.`consume_details` WHERE `deleted_at` IS NULL AND `district_cd`='" . $_SESSION['district'] . "'";
            $result = mysqli_query($this->conn, $query);
            $row = mysqli_fetch_assoc($result);
            return $row['totalItem'];

        }
    }

//////////////paginator
    public function paginator($pageStartFrom=0,$Limit=5){
        if ($_SESSION['role']==1) {
            $query = "SELECT * FROM `neci`.`consume_details` WHERE `deleted_at` IS NULL  ORDER BY ID DESC LIMIT " . $pageStartFrom . "," . $Limit;
            // AND `district_cd`='" . $_SESSION['district'] . "'
            $_allval = array();
            $result = mysqli_query($this->conn, $query);
            //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
            while ($row = mysqli_fetch_assoc($result)) {
                $_allval[] = $row;
            }

            return $_allval;
        }else {
            $query = "SELECT * FROM `neci`.`consume_details` WHERE `deleted_at` IS NULL AND `district_cd`='" . $_SESSION['district'] . "' ORDER BY ID DESC LIMIT " . $pageStartFrom . "," . $Limit;
            //AND `district_cd`='".$this->district_cd."'   '".$this->district_cd."'
            $_allval = array();
            $result = mysqli_query($this->conn, $query);
            //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
            while ($row = mysqli_fetch_assoc($result)) {
                $_allval[] = $row;
            }

            return $_allval;

        }


    }
}
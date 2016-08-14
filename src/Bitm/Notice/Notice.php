<?php
namespace  App\Bitm\Notice;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\Model\Database as DB;
use MongoDB\Driver\Query;

class Notice extends DB{
    //Variable Declare
    public $id="";
    public $notice_title="";
    public $notice_content="";
    public $district_cd="";
    public $user_id="";
    public $notice_date="";
    public $notice_time="";
    public $status="";
    public $conn;
    public $deleted_at;

///Prepare the data
    public function prepare($data=Array()){
        if(array_key_exists("notice_title",$data)){
            $this->notice_title= $data['notice_title'];
        }
        if(array_key_exists("notice_content",$data)){
            $this->notice_content= $data['notice_content'];
        }

        if(array_key_exists("district_cd",$data)){
            $this->district_cd= $data['district_cd'];
        }
        if(array_key_exists("user_id",$data)) {
            $this->user_id = filter_var($data['user_id'], FILTER_SANITIZE_STRING);
        }

        if(array_key_exists("notice_date",$data)){
            $this->notice_date= $data['notice_date'];
        }
        if(array_key_exists("notice_time",$data)){
            $this->notice_time= $data['notice_time'];
        }

        if(array_key_exists("status",$data)){
            $this->status= $data['status'];
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

////Storeing Data
    public function store_notice_details(){
        $query="INSERT INTO `neci`.`notice_details` 
       (`notice_title`, `notice_content`, `district_cd`, `user_id`, `notice_date`, `notice_time`) 
       VALUES ('".$this->notice_title. "','".$this->notice_content. "' ,'".$this->district_cd. "', '".$this->user_id. "','".$this->notice_date. "', Now())";
               // VALUES ('".$this->district_cd. "','".$this->district_name."')";
// echo $query;
//   die();
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
                                    <strong>Success!</strong> Data has been stored successfully.
                                    </div>");
            header('Location:../../views/User/notice_index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
                                    <strong>Error!</strong> Data has not been stored successfully.
                                    </div>");
            Utility::redirect('../../views/User/add_notice.php');
        }
    }
/////Display Data All  without trash
    public function index(){
        $_allData= array();
        $query="SELECT * FROM `neci`.`notice_details` WHERE `deleted_at` IS NULL and `status`=1 ";
        $result= mysqli_query($this->conn,$query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while($row= mysqli_fetch_assoc($result)){
            $_allData[]=$row;
        }
        return $_allData;
    }

    public function display(){
        $_allData= array();
        $query="SELECT * FROM `neci`.`notice_details` WHERE `deleted_at` IS NULL and `notice_date`=CURRENT_DATE() and `status`=1 ";
        $result= mysqli_query($this->conn,$query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while($row= mysqli_fetch_assoc($result)){
            $_allData[]=$row;
        }
        return $_allData;
    }

/////View Data
    public function view(){
        $query="SELECT * FROM `neci`.`notice_details` WHERE `id`=".$this->id;
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row;
    }

/////Update  Single Data
    public function update(){
        $query="UPDATE `neci`.`notice_details` SET `notice_date` = '".$this->notice_date."',`notice_title` = '".$this->notice_title."' ,`notice_content` = '".$this->notice_content."'
             WHERE `notice_details`.`id` =".$this->id;
        //Utility::dd($query);
        //$result= mysqli_query($this->conn,$query);
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
                                    <strong>Success!</strong> Data has been Updated successfully.
                                    </div>");
            header('Location:../../views/User/notice_index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
                                    <strong>Error!</strong> Data has not been Edited successfully.
                                    </div>");
            header('Location:../../views/User/Edit_notice.php');
        }

    }
////Delete Single Data
    public function delete(){
        $query="DELETE FROM `neci`.`notice_details` WHERE `notice_details`.`id` = ".$this->id;
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
            header('Location:../../views/User/dashboard.php');
        }
    }
//////////trash temporary
    public function trash(){
        $this->deleted_at=time();
        $query="UPDATE `neci`.`notice_details` SET `deleted_at` = '".$this->deleted_at."' WHERE `notice_details`.`id` = ".$this->id;
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
        $query="SELECT * FROM `neci`.`notice_details` WHERE `deleted_at` IS NOT NULL";
        $result= mysqli_query($this->conn,$query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while($row= mysqli_fetch_assoc($result)){
            $_trashedBook[]=$row;
        }

        return $_trashedBook;

    }
    /////trashcount
//    public function trashedcount(){
//        $query="SELECT count(*) AS tcount FROM `neci`.`notice_details` WHERE `deleted_at` IS NOT NULL";
//        $result= mysqli_query($this->conn,$query);
//        $row= mysqli_fetch_assoc($result);
//        return $row['tcount'];
//
//    }

//////////recover single
    public function recover(){
        $query="UPDATE `neci`.`notice_details` SET `deleted_at` = NULL  WHERE `id` = ".$this->id;
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
//    public function recoverMultiple($idS=array()){
//        if((is_array($idS)) && count($idS)>0){
//            $IDs= implode(",",$idS);
//            $query="UPDATE `neci`.`district_info` SET `deleted_at` = NULL  WHERE `district_info`.`id` IN(".$IDs.")";
//            //result= mysqli_query($this->conn,$query);
//            $result= mysqli_query($this->conn,$query);
//            if($result){
//                Message::message("<div class=\"alert alert-success\">
//  <strong>Recovered!</strong> Selected Data has been recovered successfully.
//</div>");
//                header('Location:index.php');
//
//            } else {
//                Message::message("<div class=\"alert alert-danger\">
//  <strong>Error!</strong> Selected Data has not been recovered successfully.
//    </div>");
//                Utility::redirect('index.php');
//
//            }
//
//
//
//        }
//
//    }

//////////delete multiple
    public function deleteMultiple($idS=array()){
        if((is_array($idS)) && count($idS)>0){
            $IDs= implode(",",$idS);
            $query="DELETE FROM `neci`.`notice_details`  WHERE `notice_details`.`id` IN(".$IDs.")";
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
        $query="SELECT COUNT(*) AS totalItem FROM `neci`.`notice_details` WHERE `deleted_at` IS NULL";
        $result=mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

//////////////paginator
    public function paginator($pageStartFrom=0,$Limit=5){
        $query="SELECT * FROM `neci`.`notice_details` WHERE `deleted_at` IS NULL  ORDER BY ID DESC LIMIT ".$pageStartFrom.",".$Limit;
        $_allData= array();
        $result= mysqli_query($this->conn,$query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while($row= mysqli_fetch_assoc($result)){
            $_allData[]=$row;
        }

        return $_allData
            ;

    }

//////////////////////max district cd sl
//    public function sl_count(){
//        $query='SELECT MAX(district_cd) as maxsl from district_info';
//        $result=mysqli_query($this->conn,$query);
//        $row= mysqli_fetch_assoc($result);
//        return $row['maxsl'];
//    }


}
<?php
namespace  App\Bitm\District;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

if (!isset($_SESSION)){
    session_start();
}



class District{
    //Variable Declare
    public $id="";
    public $district_cd="";
    public $district_name="";
    public $conn;
    public $deleted_at;

///Prepare the data
    public function prepare($data=Array()){
        if(array_key_exists("district_cd",$data)){
            $this->district_cd= $data['district_cd'];
        }
        if(array_key_exists("district_name",$data)) {
            $this->district_name = filter_var($data['district_name'], FILTER_SANITIZE_STRING);
        }
        if(array_key_exists("id",$data)){
            $this->id= $data['id'];
        }
        return $this;
    }
////Prepare Connection
    public function __construct()
    {
        $this->conn= mysqli_connect("localhost","root","","neci") or die("Database connection failed");
    }

////Storeing Data
    public function store_district_details(){
        $query="INSERT INTO `neci`.`district_info` (`district_cd`, `district_name`) 
                VALUES ('".$this->district_cd. "','".$this->district_name."')";
        echo $query;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
                                    <strong>Success!</strong> Data has been stored successfully.
                                    </div>");
            header('Location:index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
                                    <strong>Error!</strong> Data has not been stored successfully.
                                    </div>");
            Utility::redirect('index.php');
        }
    }
/////Display Data All  without trash
    public function index(){
        $_allData= array();
        $query="SELECT * FROM `neci`.`district_info` WHERE `deleted_at` IS NULL";
        $result= mysqli_query($this->conn,$query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while($row= mysqli_fetch_assoc($result)){
            $_allData[]=$row;
        }
        return $_allData;
    }

/////View Data
    public function view(){
    $query="SELECT * FROM `neci`.`district_info` WHERE `id`=".$this->id;
    $result= mysqli_query($this->conn,$query);
    $row= mysqli_fetch_assoc($result);
    return $row;
}

////////distrct name
    public function districtnm(){
        $query='SELECT district_name FROM `neci`.`district_info` WHERE `district_cd`= "'.$_SESSION['district'].'"';
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row;
    }

    public function districtname(){
        $query='SELECT district_name FROM `neci`.`district_info` WHERE `district_cd`= "'.$this->district_cd.'"';
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row;
    }


    
/////Update  Single Data
    public function update(){
        $query="UPDATE `neci`.`district_info` SET `district_name` = '".$this->district_name."' 
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
////Delete Single Data
    public function delete(){
        $query="DELETE FROM `neci`.`district_info` WHERE `district_info`.`id` = ".$this->id;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
            <strong>Deleted!</strong> Data has been deleted successfully.
            </div>");
            header('Location:index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
            <strong>Error!</strong> Data has not been deleted successfully.
            </div>");
            Utility::redirect('index.php');
        }
    }
//////////trash temporary
    public function trash(){
        $this->deleted_at=time();
        $query="UPDATE `neci`.`district_info` SET `deleted_at` = '".$this->deleted_at."' WHERE `district_info`.`id` = ".$this->id;
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
        $query="SELECT * FROM `neci`.`district_info` WHERE `deleted_at` IS NOT NULL";
        $result= mysqli_query($this->conn,$query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while($row= mysqli_fetch_assoc($result)){
            $_trashedBook[]=$row;
        }

        return $_trashedBook;

    }
    /////trashcount
    public function trashedcount(){
        $query="SELECT count(*) AS tcount FROM `neci`.`district_info` WHERE `deleted_at` IS NOT NULL";
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['tcount'];

    }

//////////recover single
    public function recover(){
        $query="UPDATE `neci`.`district_info` SET `deleted_at` = NULL  WHERE `id` = ".$this->id;
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
            $query="UPDATE `neci`.`district_info` SET `deleted_at` = NULL  WHERE `district_info`.`id` IN(".$IDs.")";
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
            $query="DELETE FROM `neci`.`district_info`  WHERE `district_info`.`id` IN(".$IDs.")";
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
        $query="SELECT COUNT(*) AS totalItem FROM `neci`.`district_info` WHERE `deleted_at` IS NULL";
        $result=mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

//////////////paginator
    public function paginator($pageStartFrom=0,$Limit=5){
        $query="SELECT * FROM `neci`.`district_info` WHERE `deleted_at` IS NULL  ORDER BY ID DESC LIMIT ".$pageStartFrom.",".$Limit;
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
        public function sl_count(){
            $query='SELECT MAX(district_cd) as maxsl from district_info';
            $result=mysqli_query($this->conn,$query);
            $row= mysqli_fetch_assoc($result);
            return $row['maxsl'];
        }


}
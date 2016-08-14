<?php
namespace  App\Bitm\Consume;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\Model\Database as DB;
class Consume extends DB{
    //Variable Declare
    public $id="";
    public $notice_title="";
    public $notice_content="";
    public $district_cd="";
    public $user_id="";
    public $notice_date="";
    public $notice_time="";
    public $status="";
    public $city="";
    public $fdate="";
    public $tdate="";
    public $fyear="";
    public $input_date="";
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
        if(array_key_exists("city",$data)){
            $this->city= $data['city'];
        }
        if(array_key_exists("fdate",$data)){
            $this->fdate= $data['fdate'];
        }
        if(array_key_exists("tdate",$data)){
            $this->tdate= $data['tdate'];
        }
        if(array_key_exists("fyear",$data)){
            $this->fyear= $data['fyear'];
        }
        if(array_key_exists("input_date",$data)){
            $this->input_date= $data['input_date'];
        }
        return $this;
    }



////Prepare Connection
//    public function __construct()
//    {
//        $this->conn= mysqli_connect("localhost","root","","neci") or die("Database connection failed");
//    }

////Storeing Data
    public function consume_details(){
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
//        $query="SELECT * FROM `neci`.`consume_details` WHERE `deleted_at` IS NULL and `input_date`= date('Y-m-d') ";

        $query="SELECT * FROM consume_details WHERE `input_date`= CURDATE() ORDER BY `input_date` DESC  ";


        $result= mysqli_query($this->conn,$query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while($row= mysqli_fetch_assoc($result)){
            $_allData[]=$row;
        }
        return $_allData;
    }

///////////Summary Consume Data
    public function summary(){
     $_allData= array();
     //$query = "SELECT sum(unit) AS summary FROM `neci`.`consume_details` WHERE `deleted_at` IS NULL AND `input_date`='" . date('Y-m-d') ."'";
//     $query = "SELECT input_date,sum(unit) AS summary FROM `neci`.`consume_details` WHERE `deleted_at` IS NULL AND input_date >= CURDATE()-4 and input_date<=CURDATE() group by input_date ORDER BY INPUT_DATE DESC ";
//     $query = "SELECT input_date,sum(unit) AS summary FROM `neci`.`consume_details` WHERE input_date >= CURDATE()-4 and input_date<=CURDATE() group by input_date ORDER BY INPUT_DATE DESC ";
       $query = "SELECT input_date,sum(unit) AS summary FROM `neci`.`consume_details` group by input_date ORDER BY INPUT_DATE DESC Limit 0,5";
        $result= mysqli_query($this->conn,$query);
     while($row= mysqli_fetch_assoc($result)){
         $_allData[]=$row;
     }
     return $_allData;
   }


///////////Summary Consume Data
    public function summary_report(){
        $_allData= array();
        $query = "SELECT c.district_cd,d.district_name,c.unit FROM consume_details c inner join district_info d on c.district_cd=d.district_cd  where input_date='" . date('Y-m-d') . "' ORDER BY unit desc limit 10";
        $result= mysqli_query($this->conn,$query);
        while($row= mysqli_fetch_assoc($result)){
            $_allData[]=$row;
        }
        return $_allData;
    }
////////////////////////for yearly  data
  


/////View Data
    public function view(){
        $query="SELECT * FROM `neci`.`notice_details` WHERE `id`=".$this->id;
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row;
    }

/////Update  Single Data
    public function update(){
        $query="UPDATE `neci`.`notice_details` SET `notice_title` = '".$this->notice_title."' ,`notice_content` = '".$this->notice_content."'
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

    //////////////////////district info
    public  function getcity()
    {
        $alcity=array();
        $query="SELECT * FROM `district_info` WHERE `deleted_at` IS NULL";
        // Utility::dd()
        $result=mysqli_query($this->conn,$query);
        while ($row=mysqli_fetch_assoc($result))
        {
            $alcity[]=$row;
        }
        return $alcity;
    }

///////////////////////data for front page index page
///////////////////////count
    public function count_index(){
        //$dd=$this->district_cd;
       // echo $dd;
            $query = "SELECT COUNT(*) AS totalItem FROM `neci`.`consume_details` WHERE `input_date`='".date('Y-m-d')."'"; ///AND `district_cd`='".$this->district_cd."'
            $result = mysqli_query($this->conn, $query);
            $row = mysqli_fetch_assoc($result);
            return $row['totalItem'];
    }

//////////////paginatore
    public function paginator_index($pageStartFrom=0,$Limit=5){

//            $query = "SELECT c.id,c.district_cd,d.district_name,c.input_date,c.unit FROM consume_details c inner join district_info d on c.district_cd=d.district_cd
//                      WHERE c.deleted_at IS NULL  AND `input_date`='".date('Y-m-d')."' ORDER BY ID DESC LIMIT " . $pageStartFrom . "," . $Limit; //AND `district_cd`='".$this->district_cd."'
            $query = "SELECT c.id,c.district_cd,d.district_name,c.input_date,c.unit FROM consume_details c inner join district_info d on c.district_cd=d.district_cd 
                      WHERE `input_date`= CURDATE() ORDER BY ID DESC LIMIT ".$pageStartFrom."," . $Limit;

            $_allval = array();
            $result = mysqli_query($this->conn, $query);
            //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
            while ($row = mysqli_fetch_assoc($result)) {
                $_allval[] = $row;
            }
            return $_allval;
        }
//////////////districtnm


/////show for seeing admin
    public function count_admin(){
        //$dd=$this->district_cd;
        // echo $dd;
//        $query = "SELECT COUNT(*) AS totalItem FROM `neci`.`consume_details` WHERE `input_date`='".date('Y-m-d')."'"; ///AND `district_cd`='".$this->district_cd."'

        $query = "SELECT count(*) as totalItemAdmin FROM 
(
SELECT d.district_cd,d.district_name,c.input_date,c.unit
                  from
                  (SELECT district_cd,input_date,unit from consume_details where input_date='".$this->input_date."'
                  ) c right outer join district_info d on c.district_cd=d.district_cd
    ) x";
        
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['totalItemAdmin'];
    }




//////////////paginator datewise data show for seeing admin
    public function paginator_dis_admin($pageStartFrom=0,$Limit=5){
        $query = "SELECT d.district_cd,d.district_name,c.input_date,c.unit
                  from
                  (SELECT district_cd,input_date,unit from consume_details where input_date='".$this->input_date."'
                  ) c right outer join district_info d on c.district_cd=d.district_cd
                  ORDER BY `d`.`district_cd` ASC LIMIT ".$pageStartFrom."," . $Limit;

        $_allval = array();
        $result = mysqli_query($this->conn, $query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while ($row = mysqli_fetch_assoc($result)) {
            $_allval[] = $row;
        }
        return $_allval;
    }
//////////////districtnm






    public function districtnm(){
        $query="SELECT district_name FROM `neci`.`district_info` WHERE `district_cd`='".$this->district_cd."'";
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row;
    }
///////////////////end data for front page index page
//////////////////STATEMENT AS DAILY




//////////////////////count
    public function count_d(){
        //$dd=$this->district_cd;
        // echo $dd;
        $query = "SELECT COUNT(*) AS totalItem FROM `neci`.`consume_details` WHERE `deleted_at` IS NULL  AND `input_date`>='".$this->fdate."'  AND `input_date`<='".$this->tdate."'";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

//////////////paginatore
    public function paginator_d($pageStartFrom=0,$Limit=5){

        $query = "SELECT * FROM `neci`.`consume_details` WHERE `deleted_at` IS NULL  AND `input_date`>='".$this->fdate."'  AND `input_date`<='".$this->tdate."' 
        ORDER BY input_date DESC LIMIT " . $pageStartFrom . "," . $Limit;
     
//        echo $query;
//        die();
        $_allval = array();
        $result = mysqli_query($this->conn, $query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while ($row = mysqli_fetch_assoc($result)) {
            $_allval[] = $row;
        }
        return $_allval;
    }
//////////////districtnm
    public function districtnm_d(){
        $query="SELECT district_name FROM `neci`.`district_info` WHERE `district_cd`='".$this->district_cd."'";
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row;
    }

//////////////////STATEMENT AS daily




    //////////////////////district info
    public  function getYear()
    {
        $allYear=array();
        $query="SELECT YEAR (input_date) as cyear FROM `consume_details` group by YEAR (input_date)";
        // Utility::dd()
        $result=mysqli_query($this->conn,$query);
        while ($row=mysqli_fetch_assoc($result))
        {
            $allYear['cyear']=$row;
        }
        return $allYear;
    }

///////////Summary Consume Data
    public function yearly_summary_report(){
//
        //$query="select input_date as month,unit AS stotal from  consume_details where input_date='2016-07-29'";
        $query = "SELECT DATE_FORMAT(input_date, '%b') as nmonth,sum(unit) AS stotal FROM consume_details WHERE deleted_at IS NULL and Year(input_date) = '".$this->fyear."' group by MONTHNAME(input_date)";
        
//        echo $query;
         $_allData = array();
        $result = mysqli_query($this->conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $_allData[] = $row;
            }
            return $_allData;
        
    }





}
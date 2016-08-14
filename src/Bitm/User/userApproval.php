<?php
namespace  App\Bitm\User;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\Model\Database as DB;


class userApproval extends DB{
///Prepare the data

    public $district_cd="";
    
    public function prepare($data=Array()){
        if(array_key_exists("id",$data)){
            $this->id= $data['id'];
        }
        if(array_key_exists("user_id",$data)) {
            $this->user_id = filter_var($data['user_id'], FILTER_SANITIZE_STRING);
        }
        if(array_key_exists("email",$data)){
            $this->email= $data['email'];
        }
        if(array_key_exists("status",$data)){
            $this->status= $data['status'];
        }
        if(array_key_exists("district_cd",$data)){
            $this->district_cd= $data['district_cd'];
        }
        return $this;
    }


////Storeing Data
    public function store_notice_details(){
        $query="INSERT INTO `neci`.`notice_details` 
       (`notice_title`, `notice_content`, `district_cd`, `user_id`, `notice_date`, `notice_time`) 
       VALUES ('".$this->notice_title. "','".$this->notice_content. "' ,'".$this->district_cd. "', '".$this->user_id. "','".$this->notice_date. "', Now())";

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
    public function userList(){
        $_allData= array();
        $query="SELECT id,user_id,email,status,signup_date FROM user_info ORDER BY signup_date DESC";
        $result= mysqli_query($this->conn,$query);
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
        //UPDATE user_info SET status = 1  WHERE id =".$this->id;
        $query="UPDATE `neci`.`user_info` SET `status` = '1' 
             WHERE `id` =".$this->id;

        //Utility::dd($query);
        //$result= mysqli_query($this->conn,$query);
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
                                    <strong>Success!</strong> Data has been Updated successfully.
                                    </div>");
            header('Location:../../views/User/user_approval.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
                                    <strong>Error!</strong> Data has not been Updated successfully.
                                    </div>");
            header('Location:../../views/User/user_approval.php');
        }

    }
////Delete Single Data
    public function delete(){
        $query="DELETE FROM user_info WHERE id = ".$this->id;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
            <strong>Deleted!</strong> Data has been deleted successfully.
            </div>");
            header('Location:../../views/User/user_approval.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
            <strong>Error!</strong> Data has not been deleted successfully.
            </div>");
            header('Location:../../views/User/user_approval.php');
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


///////////////////////count for user
//
//    public function districtnm(){
//        $_allData= array();
//        $query = "SELECT c.district_cd,d.district_name,c.unit FROM consume_details c inner join district_info d on c.district_cd=d.district_cd  where input_date='" . date('Y-m-d') . "' ORDER BY unit desc limit 10";
//        $result= mysqli_query($this->conn,$query);
//        while($row= mysqli_fetch_assoc($result)){
//            $_allData[]=$row;
//        }
//        return $_allData;
//    }
//
//
//
//
//        $query='SELECT district_name FROM `neci`.`district_info` WHERE `district_cd`= "'.$this->district_cd.'"';
//        $result= mysqli_query($this->conn,$query);
//        $row= mysqli_fetch_assoc($result);
//        return $row;
//    }

    public function count(){
        $query="SELECT COUNT(*) AS totalItem FROM user_info";
        $result=mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

//////////////paginator
    public function paginator($pageStartFrom=0,$Limit=5){
        $query="SELECT c.id,user_id,email,status,c.district_cd as district_cd,d.district_name as district_name, signup_date,phone_no FROM user_info c LEFT JOIN district_info d on c.district_cd=d.district_cd  ORDER BY signup_date DESC  LIMIT ".$pageStartFrom.",".$Limit;
        $_allData= array();
        $result= mysqli_query($this->conn,$query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while($row= mysqli_fetch_assoc($result)){
            $_allData[]=$row;
        }

        return $_allData
            ;

    }


////////////////////////////////for admin List

    public function delete_admin(){
        $query="DELETE FROM user_info WHERE id = ".$this->id;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
            <strong>Deleted!</strong> Data has been deleted successfully.
            </div>");
//            header('Location:../../views/User/admin_list.php');
            Utility::redirect('../../views/User/admin_list.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
            <strong>Error!</strong> Data has not been deleted successfully.
            </div>");
            Utility::redirect('../../views/User/admin_list.php');
        }
    }





///////////////////////count
    public function count_admin(){
        $query="SELECT COUNT(*) AS totalItem FROM user_info where role='1'";
        $result=mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

//////////////paginator
    public function paginator_admin($pageStartFrom=0,$Limit=5){
        $query="SELECT id,user_id,email,status,signup_date FROM user_info where role='1'ORDER BY signup_date DESC LIMIT ".$pageStartFrom.",".$Limit;
        $_allData= array();
        $result= mysqli_query($this->conn,$query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while($row= mysqli_fetch_assoc($result)){
            $_allData[]=$row;
        }

        return $_allData
            ;

    }





}
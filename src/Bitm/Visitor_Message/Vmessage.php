<?php
namespace  App\Bitm\Visitor_Message;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\Model\Database as DB;
class Vmessage extends DB
{

        public $id="";
        public $input_date="";
        public $district_cd="";
        public $district_name="";
        public $visitor_name="";
        public $visitor_email="";
        public $visitor_phone="";
        public $visitor_message="";
        public $conn;
    ///   public $deleted_at;

///Prepare the data
    public function prepare($data = Array())
    {
        if (array_key_exists("input_date", $data)) {
            $this->input_date = $data['input_date'];
        }
        if (array_key_exists("district_cd", $data)) {
            $this->district_cd = $data['district_cd'];
        }

        if (array_key_exists("district_name", $data)) {
            $this->district_name = $data['district_name'];

        }
        if (array_key_exists("visitor_name", $data)) {
            $this->visitor_name = $data['visitor_name'];
        }

        if (array_key_exists("visitor_email", $data)) {
            $this->visitor_email = $data['visitor_email'];
        }
        if (array_key_exists("visitor_phone", $data)) {
            $this->visitor_phone = $data['visitor_phone'];
        }

        if (array_key_exists("visitor_message", $data)) {
            $this->visitor_message = $data['visitor_message'];
        }
        if (array_key_exists("id", $data)) {
            $this->id = $data['id'];
        }
        return $this;
    }

////Prepare Connection
//    public function __construct()
//    {
//        $this->conn= mysqli_connect("localhost","root","","neci") or die("Database connection failed");
//    }




////Storeing Data
    public function store_vmessage_details(){
        $query="INSERT INTO `neci`.`message` (`input_date`, `district_cd`, `district_name`, `visitor_name`, `visitor_email`, `visitor_phone`, `visitor_message`) 
        VALUES (Now(),'".$this->district_cd. "', '".$this->district_name. "', '".$this->visitor_name. "',
         '".$this->visitor_email. "', '".$this->visitor_phone. "', '".$this->visitor_message. "');";
        //echo $query;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
                                    <strong>Success!</strong> Data has been stored successfully.
                                    </div>");

            Utility::redirect('../../index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
                                    <strong>Error!</strong> Data has not been stored successfully.
                                    </div>");
            Utility::redirect('../../index.php');
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
    public function view_message(){
        $query='SELECT * FROM `neci`.`message` WHERE `district_cd`= "'.$_SESSION['district'].'"';
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row;
    }

///////////////////////count message
    public function count_message(){
        $query='SELECT COUNT(*) AS totalMessage FROM `neci`.`message` WHERE `district_cd`= "'.$_SESSION['district'].'"';
        $result=mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalMessage'];
    }

//////////////paginator
    public function paginator_message($pageStartFrom=0,$Limit=5){
        $query="SELECT * FROM `neci`.`message` WHERE `district_cd`='".$_SESSION['district']."'  ORDER BY ID DESC LIMIT ".$pageStartFrom.",".$Limit;
        $_allData= array();
        $result= mysqli_query($this->conn,$query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while($row= mysqli_fetch_assoc($result)){
            $_allData[]=$row;
        }

        return $_allData
            ;

    }    
    
    
    
    
    
////////distrct name
    public function districtnm(){
        $query='SELECT district_name FROM `neci`.`district_info` WHERE `district_cd`= "'.$_SESSION['district'].'"';
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

            Utility::redirect('../../../index.php#contact');

        } else {
            Message::message("<div class=\"alert alert-danger\">
            <strong>Error!</strong> Data has not been updated  successfully.
            </div>");
            Utility::redirect('../../../index.php#contact');

        }

    }
////Delete Single Data
    public function delete(){
        $query="DELETE FROM `neci`.`message` WHERE `message`.`id` = ".$this->id;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
            <strong>DELETED!</strong> Data has been Deleted successfully.
            </div>");

            Utility::redirect('../../views/User/message_index.php');
        } else {
            Message::message("<div class=\"alert alert-danger\">
            <strong>Error!</strong> Data has not been Deleted successfully.
            </div>");
            Utility::redirect('../../views/User/message_index.php');
        }
    }
////////////////////////////////////////////
//////////trash temporary
    public function volt(){
        //$this->deleted_at=time();
        $query="UPDATE `neci`.`message` SET `deleted_at` = '1' WHERE `message`.`id` = ".$this->id;
        //Utility::dd($query);
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
            <strong>Trashed!</strong> Data has been trashed successfully.
            </div>");

            Utility::redirect('../../views/User/message_index.php');
        } else {
            Message::message("<div class=\"alert alert-danger\">
            <strong>Error!</strong> Data has not been trashed successfully.
            </div>");
            Utility::redirect('../../views/User/message_index.php');
        }
    }





/////Display Data All  without trash
    public function index_Boardmember()
    {
        $_allData = array();
        $query = "SELECT u.district_cd,d.district_name,p.first_name,p.last_name,p.designation,u.phone_no,u.email FROM `user_info` u inner join user_profile p on u.user_id=p.user_id inner join district_info d on u.district_cd=d.district_cd ";
        $result = mysqli_query($this->conn, $query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while ($row = mysqli_fetch_assoc($result)) {
            $_allData[] = $row;
        }
        return $_allData;
    }



///////////////////////data for front page index page
///////////////////////count
    public function count__Boardmember()
    {
        $query = "select count(*) as totalBmember
from
(
SELECT u.district_cd,d.district_name,p.first_name,p.last_name,p.designation,u.phone_no,u.email FROM `user_info` u left join user_profile p on u.user_id=p.user_id inner join district_info d on u.district_cd=d.district_cd
)s "; ///AND `district_cd`='".$this->district_cd."'
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['totalBmember'];
    }

//////////////paginatore
    public function paginator__Boardmember($pageStartFrom = 0, $Limit = 5)
    {

        $query = "SELECT u.district_cd,d.district_name,p.first_name,p.last_name,p.designation,u.phone_no,u.email FROM `user_info` u left join user_profile p on u.user_id=p.user_id inner join district_info d on u.district_cd=d.district_cd
          ORDER BY district_name LIMIT " . $pageStartFrom . "," . $Limit; //AND `district_cd`='".$this->district_cd."'
        // echo $query;

        $_allval = array();
        $result = mysqli_query($this->conn, $query);
        //You can also use mysqli_fetch_object e.g: $row= mysqli_fetch_object($result)
        while ($row = mysqli_fetch_assoc($result)) {
            $_allval[] = $row;
        }
        return $_allval;

    }

}
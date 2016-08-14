<?php
namespace  App\Bitm\BoardMember;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\Model\Database as DB;
class BoardMember extends DB
{
    //Variable Declare
//    public $id="";
//    public $notice_title="";
//    public $notice_content="";
//    public $district_cd="";
//    public $user_id="";
//    public $notice_date="";
//    public $notice_time="";
//    public $status="";
    public $conn;
    ///   public $deleted_at;

///Prepare the data
    public function prepare($data = Array())
    {
        if (array_key_exists("notice_title", $data)) {
            $this->notice_title = $data['notice_title'];
        }
        if (array_key_exists("notice_content", $data)) {
            $this->notice_content = $data['notice_content'];
        }

        if (array_key_exists("district_cd", $data)) {
            $this->district_cd = $data['district_cd'];

        }
        if (array_key_exists("user_id", $data)) {
            $this->user_id = filter_var($data['user_id'], FILTER_SANITIZE_STRING);
        }

        if (array_key_exists("notice_date", $data)) {
            $this->notice_date = $data['notice_date'];
        }
        if (array_key_exists("notice_time", $data)) {
            $this->notice_time = $data['notice_time'];
        }

        if (array_key_exists("status", $data)) {
            $this->status = $data['status'];
        }
        if (array_key_exists("id", $data)) {
            $this->id = $data['id'];
        }
        if (array_key_exists("city", $data)) {
            $this->city = $data['city'];
        }
        if (array_key_exists("fdate", $data)) {
            $this->fdate = $data['fdate'];
        }
        if (array_key_exists("tdate", $data)) {
            $this->tdate = $data['tdate'];
        }
        return $this;
    }

////Prepare Connection
//    public function __construct()
//    {
//        $this->conn= mysqli_connect("localhost","root","","neci") or die("Database connection failed");
//    }


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
        //$dd=$this->district_cd;
        // echo $dd;
        $query = "select count(*) as totalBmember
from
(
SELECT u.district_cd,d.district_name,u.first_name,u.last_name,u.designation,u.phone_no,u.email FROM `user_info` u left join user_profile p on u.user_id=p.user_id inner join district_info d on u.district_cd=d.district_cd
)s "; ///AND `district_cd`='".$this->district_cd."'
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['totalBmember'];
    }

//////////////paginatore
    public function paginator__Boardmember($pageStartFrom = 0, $Limit = 5)
    {

        $query = "SELECT u.district_cd,d.district_name,u.first_name,u.last_name,u.designation,u.phone_no,u.email FROM `user_info` u left join user_profile p on u.user_id=p.user_id inner join district_info d on u.district_cd=d.district_cd
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
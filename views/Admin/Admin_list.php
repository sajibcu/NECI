<?php
session_start();
include_once ('../../vendor/autoload.php');
use App\Bitm\User\userApproval;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;


$uApproval= new userApproval();
$totalItem=$uApproval->count_admin();

// Utility::dd($totalUserList);
// die();

if(array_key_exists('itemPerPage',$_SESSION)){
    if(array_key_exists('itemPerPage',$_GET)){
        $_SESSION['itemPerPage']=$_GET['itemPerPage'];
    }
}
else{
    $_SESSION['itemPerPage']=5;
}

$itemPerPage= $_SESSION['itemPerPage'];


$noOfPage= ceil($totalItem/$itemPerPage);
//Utility::d($noOfPage);
$pagination="";
if(array_key_exists('pageNumber',$_GET)){
    $pageNo=$_GET['pageNumber'];
}
else{
    $pageNo=1;
}
for($i=1;$i<=$noOfPage;$i++){
    $active=($pageNo==$i)?"active":"";
    $pagination.="<li class='$active'><a href='../User/admin_list.php?pageNumber=$i'>$i</a></li>";
}

$pageStartFrom=$itemPerPage*($pageNo-1);

$allUser=$uApproval->paginator_admin($pageStartFrom,$itemPerPage);
//Utility::dd($allUser);
//die();
$prev=$pageNo-1;
$next=$pageNo+1;
?>

<div class="container">
    <div class="content">
        <div class="content-container">
            <div class="content-header">
                <h2 class="content-header-title">Welcome to National Electricity Consumption Information (NECI)</h2>
                <ol class="breadcrumb">
                    <li><a href="./dashboard.php">Dashboard</a></li>
                    <li><a href="javascript:;">Manage</a></li>
                    <li class="active">User Approval</li>
                </ol>
            </div>

            <div class="row padnone">
                <div class="col-md-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="align-left">
                            <h4>
                                <a href="#" style="text-decoration:none">
                                    <span class="btn-blue" style="">User Approval</span>
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div><br />


            <div id="message">

                <?php  if ((array_key_exists('message',$_SESSION)&&!empty($_SESSION['message']))){
                    echo Message::message();
                }
                ?>
            </div>



            <div class="row">
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-lg-12 col-md-10 col-sm-10 col-xs-10">
                    <div class=""><!-- ebox-->

                        <label for="sel1">Select Item Per Page (select one):</label>

                        <form role="form" action="../User/admin_list.php">
                            <div class="form-group">

                                <select class="form-control" id="sel1" name="itemPerPage" style="width:auto;float:left;">
                                    <option <?php if($_SESSION['itemPerPage']==5) {echo "selected";}?>>5</option>
                                    <option <?php if($_SESSION['itemPerPage']==10) {echo "selected";}?>>10</option>
                                    <option <?php if($_SESSION['itemPerPage']==15) {echo "selected";}?>>15</option>
                                    <option <?php if($_SESSION['itemPerPage']==20) {echo "selected";}?>>20</option>
                                    <option <?php if($_SESSION['itemPerPage']==25) {echo "selected";}?>>25</option>
                                </select>
                                <button type="submit" class="btn btn-warning" style="width:auto;float:left;">Submit</button>
                                <br>
                            </div>
                        </form>


                        <div class="table-responsive">

                            <table
                                class="table table-striped table-bordered table-hover table-highlight table-checkable"
                                data-provide="datatable"
                                data-search="false"
                                data-length-change="true"
                            >
                                <thead>
                                <tr class="">
                                    <th data-sortable="true">SL</th>
                                    <th data-filterable="true" data-sortable="true">User ID</th>
                                    <th data-filterable="true" data-sortable="true">Email</th>
                                    <th data-filterable="true" data-sortable="true">Date</th>
                                    <th data-filterable="true" data-sortable="true">Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sl=0;
                                foreach($allUser as $data){
                                    $uid=$data['id'];
                                    $status=$data['status'];
                                    $sl++;
                                    ?>
                                    <tr class="">
                                        <td width=""><?php echo $sl+$pageStartFrom ?></td>
                                        <td width=""><?php echo $data['user_id']?></td>
                                        <td width=""><?php echo $data['email']?></td>
                                        <td width=""><?php echo date('d-M-Y',strtotime($data['signup_date']))?></td>
                                        <td width=""><?php echo $status?></td>
                                        <td>
                                        <a href="../Admin/delete_admin.php?id=<?php echo $data['id']?>" class="btn btn-primary  btn-xs" role="button">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                            <ul class="pagination">
                                <?php if($pageNo>1) {echo "<li><a href='../User/admin_list.php?pageNumber=$prev'>Prev</a></li>";}else{echo "";}?>
                                <?php echo $pagination?>
                                <?php if($pageNo<$noOfPage){echo "<li><a href='../User/admin_list.php?pageNumber=$next'>Next</a></li>";}else{echo "";}?>
                            </ul>

                            <br />

                            <a href="pdf.php" class="btn btn-info" role="button">Download as PDF</a>&nbsp;
                            <a href="xls.php" class="btn btn-info" role="button">Download as XL</a>&nbsp;
                            <a href="mail.php" class="btn btn-info" role="button">Send Mail</a>

                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
            </div>
        </div>
    </div>
</div>
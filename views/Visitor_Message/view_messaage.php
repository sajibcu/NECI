<?php
session_start();
include_once('../../vendor/autoload.php.');
use App\Bitm\Visitor_Message\Vmessage;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;


$vMessage= new Vmessage();
//$allBook=$book->index();
//$trasc=$book->trashedcount();
$tvMessage=$vMessage->count_message();
//Utility::dd($totalItem);
//die();

if(array_key_exists('itemPerPage',$_SESSION)){
    if(array_key_exists('itemPerPage',$_GET)){
        $_SESSION['itemPerPage']=$_GET['itemPerPage'];
    }
}
else{
    $_SESSION['itemPerPage']=5;
}

$itemPerPage= $_SESSION['itemPerPage'];


$noOfPage= ceil($tvMessage/$itemPerPage);
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
    $pagination.="<li class='$active'><a href='message_index.php?pageNumber=$i'>$i</a></li>";
}

$pageStartFrom=$itemPerPage*($pageNo-1);

$allMessage=$vMessage->paginator_message($pageStartFrom,$itemPerPage);
//Utility::dd($allMessage);
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
                    <li class="active">Notice List</li>
                </ol>
            </div>

            <div class="row padnone">
                <div class="col-md-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="align-left">
                            <h4>
                                <a href="#" style="text-decoration:none">
                                    <span class="btn-blue" style="">Message List</span>
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

                        <form role="form" action="../User/notice_index.php">
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
            <tr>
                <th>SL.</th>
                <th data-filterable="true" data-sortable="true">Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sl=0;
            foreach($allMessage as $data){
                $sl++;
                $idd=$data['id'];
                $deletedat=$data['deleted_at'];
                if($deletedat==0) {
                    $deleted_at="<a href=\"../Visitor_Message/trash_messsage.php?id=".$idd."\"class=\"btn btn-info btn-xs\" role='button'>Unread</a>";
                } else {
                    $deleted_at="<a href=\"../Visitor_Message/trash_messsage.php?id=".$idd."\" class=\"btn btn-success btn-xs\" role='button'>Read</a>";

                }
               // Utility::dd($deleted_at);
                ?>


                <tr>
                    <td width="6%"><?php echo $sl+$pageStartFrom ?></td>
                    <td width="12%"><?php echo date('d-M-Y',strtotime($data['input_date']))?></td>
                    <td width="10%"><?php echo $data['visitor_name'] ?></td>
                    <td width="12%"><?php echo $data['visitor_email'] ?></td>
                    <td width="12%"><?php echo $data['visitor_phone'] ?></td>
                    <td width="30%"><?php echo $data['visitor_message'] ?></td>
                    <!-- date ("d/m/y l");
                     -->
                    <td width="18%">
                        <a href="../Visitor_Message/delete.php?id=<?php echo $data['id']?>" class="btn btn-primary  btn-xs" role="button">Delete</a>
                        <?php echo $deleted_at?>
                    </td>


                </tr>
            <?php } ?>


            </tbody>
                            </table>
                            <ul class="pagination">
                                <?php if($pageNo>1) {echo "<li><a href='message_index.php?pageNumber=$prev'>Prev</a></li>";}else{echo "";}?>
                                <?php echo $pagination?>
                                <?php if($pageNo<$noOfPage){echo "<li><a href='message_index.php?pageNumber=$next'>Next</a></li>";}else{echo "";}?>
                            </ul>

                            <!--      <a href="pdf.php" class="btn btn-info" role="button">Download as PDF</a>&nbsp;-->
                            <!--      <a href="xls.php" class="btn btn-info" role="button">Download as XL</a>&nbsp;-->
                            <!--      <a href="mail.php" class="btn btn-info" role="button">Send Mail</a>-->

                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
            </div>
        </div>
    </div>
</div>

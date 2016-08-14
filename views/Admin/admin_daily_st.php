<?php
include_once('../../vendor/autoload.php');
use App\Bitm\Consume\Consume;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;
use App\Bitm\District\District;
if(!isset($_SESSION)) {
    session_start();
}

$data = new Consume();

//if(!array_key_exists('fdate',$_SESSION)&&!array_key_exists('tdate',$_SESSION)) {
if (array_key_exists('fdate', $_GET) && array_key_exists('tdate', $_GET)) {
    $_SESSION['fdate'] = $_GET['fdate'];
    $_SESSION['tdate'] = $_GET['tdate'];
}
if(!array_key_exists('fdate',$_SESSION)&&!array_key_exists('tdate',$_SESSION)) {
    $_SESSION['fdate'] = strtoupper(date('Y-m-d'));
    $_SESSION['tdate'] = strtoupper(date('Y-m-d'));
}
//}
$totalItem=$data->prepare($_SESSION)->count_d();


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
    $pagination.="<li class='$active'><a href='user_daily_st.php?pageNumber=$i'>$i</a></li>";
}

$pageStartFrom=$itemPerPage*($pageNo-1);

$allData=$data->prepare($_SESSION)->paginator_d($pageStartFrom,$itemPerPage);

//Utility::dd($allData);
//die();
$prev=$pageNo-1;
$next=$pageNo+1;
$disnm=$data->prepare($_SESSION)->districtnm_d();
//Utility::dd($disnm);
//die();
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
                                    <span class="btn-blue" style="">Notice List</span>
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

                        <form role="form" action="../User/user_daily_st.php" style="margin-bottom: 20px;">
                            <div class="form-group">
                                <div class="col-md-3 col-sm-12">
                                    <label for="item">Select Item Per Page (select one):</label><br />
                                    <select class="form-control" id="sel1" name="itemPerPage" style="width:auto;float:left;">
                                        <option <?php if($_SESSION['itemPerPage']==5) {echo "selected";}?>>5</option>
                                        <option <?php if($_SESSION['itemPerPage']==10) {echo "selected";}?>>10</option>
                                        <option <?php if($_SESSION['itemPerPage']==15) {echo "selected";}?>>15</option>
                                        <option <?php if($_SESSION['itemPerPage']==20) {echo "selected";}?>>20</option>
                                        <option <?php if($_SESSION['itemPerPage']==25) {echo "selected";}?>>25</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="date-2">From Date</label>
                                    <div class="input-group date ui-datepicker" data-date-format="yyyy-mm-dd">
                                        <input id="date-2" name="fdate" class="form-control" type="text" data-required="true">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <span class="help-block">yyyy-mm-dd</span>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="date-2">From Date</label>
                                    <div class="input-group date ui-datepicker" data-date-format="yyyy-mm-dd">
                                        <input id="date-2" name="tdate" class="form-control" type="text" data-required="true">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <span class="help-block">yyyy-mm-dd</span>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <button type="submit" class="btn btn-warning" style="margin-top: 25px;">Submit</button>
                                </div>

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
                                    <th data-sortable="true">SL</th>
                                    <th data-filterable="true" data-sortable="true">Date</th>
                                    <th data-filterable="true" data-sortable="true">District Name</th>
                                    <th>Usages Unit (MW)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sl=0;
                                foreach($allData as $data){
                                    $dis=new District();
                                    //Utility::dd($data);
                                    $disnm=$dis->prepare($data)->districtname();
                                    $sl++;
                                    ?>
                                    <tr>
                                        <td width="10%" align="left"><?php echo $sl+$pageStartFrom ?></td>
                                        <td width="30%" align="center"><?php  echo date('d-M-Y',strtotime($data['input_date']))?></td>
                                        <td width="30%" align="left"><?php  echo $disnm['district_name']?></td>
                                        <td width="30%" align="right" style="padding-right:40px;"><?php echo $data['unit']?></td>
                                    </tr>
                                <?php } ?>


                                </tbody>
                            </table>
                            <ul class="pagination">
                                <?php if($pageNo>1) {echo "<li><a href='user_daily_st.php?pageNumber=$prev'>Prev</a></li>";}else{echo "";}?>
                                <?php echo $pagination?>
                                <?php if($pageNo<$noOfPage){echo "<li><a href='user_daily_st.php?pageNumber=$next'>Next</a></li>";}else{echo "";}?>
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

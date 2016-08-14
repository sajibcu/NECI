<?php

include_once('../../vendor/autoload.php');

use App\Bitm\Consume\Consume;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;

session_start();
$data = new Consume();
$alcity=$data->getcity();
$testindex=$data->index();

//$allval=$data->summary();
//$trasc=$book->trashedcount();
$totalItem=$data->prepare($_GET)->count_admin();

//Utility::dd($testindex);
//die();

//Utility::dd($alcity);

//if(array_key_exists('dialy_investigation_dt',$_SESSION)){
//
//}
//else{
//    $_SESSION['dialy_investigation_dt']=date('d-M-Y',strtotime(date()));
//}

if(array_key_exists('input_date',$_SESSION)){
    if(array_key_exists('input_date',$_GET)){
        $_SESSION['input_date']=$_GET['input_date'];
    }
}
else{
    $_SESSION['input_date']=date('Y-m-d',strtotime(date()));
}



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
    $pagination.= "<li class='$active'><a href='../User/daily_investigation.php?pageNumber=$i'>$i</a></li>";
}

$pageStartFrom=$itemPerPage*($pageNo-1);

$allDistrictData=$data->prepare($_GET)->paginator_dis_admin($pageStartFrom,$itemPerPage);
//Utility::dd($allDistrictData);
//die();
$prev=$pageNo-1;
$next=$pageNo+1;
//$disnm=$data->districtnm();
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
                    <li><a href="javascript:;">Investigation</a></li>
                    <li class="active">Daily Investigation</li>
                </ol>
            </div> <!-- /.content-header -->

            <div class="row padnone">
                <div class="col-md-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="align-left">
                            <h4>
                                <a href="#" style="text-decoration:none">
                                    <span class="btn-blue" style="">Daily Investigation</span>

                                </a>
                            </h4>
                        </div>

                    </div>
                    <h4><span style="color: #FF0000;float:right;">Statement as On: <?php if(!empty($_GET['input_date'])) {echo date('M d, Y',strtotime($_GET['input_date']));} else{"";} ?></span></h4>
                </div>
            </div><br />

            <div class="row">
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-lg-12 col-md-10 col-sm-10 col-xs-10">
                    <div class=""><!-- ebox-->

                        <form role="form" action="../User/daily_investigation.php" style="margin-bottom: 20px;">
                            <div class="form-group">
                                    <div class="col-md-3 col-sm-12">
                                        <label for="item">Select Item Per Page (select one):</label><br />
                                        <select class="form-control" id="sel1" name="itemPerPage" style="width:auto;float:left;">
                                            <option <?php if($_SESSION['itemPerPage']==5) {echo "selected";}?>>5</option>
                                            <option <?php if($_SESSION['itemPerPage']==10) {echo "selected";}?>>10</option>
                                            <option <?php if($_SESSION['itemPerPage']==15) {echo "selected";}?>>15</option>
                                            <option <?php if($_SESSION['itemPerPage']==20) {echo "selected";}?>>20</option>
                                            <option <?php if($_SESSION['itemPerPage']==25) {echo "selected";}?>>25</option>
                                            <option <?php if($_SESSION['itemPerPage']==64) {echo "selected";}?>>64</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <label for="date-2">Select Date</label>
                                        <div class="input-group date ui-datepicker" data-date-format="yyyy-mm-dd">
                                            <input id="date-2" name="input_date" class="form-control" value="<?php echo $_GET['input_date']?>" type="text" data-required="true">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <span class="help-block">yyyy-mm-dd</span>
                                     </div>
                                    <div class="col-md-3 col-sm-12">
                                        <button type="submit" class="btn btn-warning" style="margin-top: 25px;">Submit</button>
                                    </div>
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
                                <th>SL</th>
                                <th data-filterable="true" data-sortable="true">District Name</th>
                                <th data-filterable="true" data-sortable="true">Phone No</th>
                                <th align="center">Usages (MW)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sl=0;
                            foreach($allDistrictData as $data){
                                $sl++;
                                $punit=$data['unit'];
                                if($punit!=0) {
                                    $qunit="<td align='right' style='color:#008000;font-weight:bold;padding-right:30px;'>$punit</td>";
                                } else {
                                    $qunit="<td align='right' style='color:#FF0000;font-weight:bold;padding-right:30px;'>0</td>";
                                }
                                ?>
                                <tr>
                                    <td align="left" style="padding-left: 10px;"><?php echo $sl+$pageStartFrom ?></td>
                                    <td align="left" style="padding-left: 30px;"><?php  echo $data['district_name']?></td>
                                    <td align="left" style="padding-left: 10px;"><?php echo $data['phone_no']?></td>
                                    <?php echo $qunit?>
                                </tr>
                            <?php } ?>


                            </tbody>
                        </table>
                        <ul class="pagination">
                            <?php if($pageNo>1) {echo "<li><a href='../User/daily_investigation.php?pageNumber=$prev'>Prev</a></li>";}else{echo "";}?>
                            <?php echo $pagination?>
                            <?php if($pageNo<$noOfPage){echo "<li><a href='../User/daily_investigation.php?pageNumber=$next'>Next</a></li>";}else{echo "";}?>
                        </ul>

                    </div>


                    </div>
                    <div class="col-lg-3 col-md-1 col-sm-1 col-xs-1"></div>

                </div><!-- /.portlet-content -->
            </div>
            <br />

    </div>

    <script>
        $('#message').show().delay(3000).fadeOut();
    </script>


</div>

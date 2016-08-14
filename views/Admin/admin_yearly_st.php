<?php

include_once('../../vendor/autoload.php');
use App\Bitm\Consume\Consume;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;
session_start();



$data = new Consume();
//$alcity=$data->getcity();
$allyear=$data->getYear();

//if(array_key_exists('fyear',$_SESSION)){
//    if(array_key_exists('fyear',$_GET)){
//        $_SESSION['fyear']=$_GET['fyear'];
//    }
//}
//else{
//    $_SESSION['fyear']='2016';
//}
//$fyear=$_SESSION['fyear'];

$ySummary = $data->prepare($_POST)->yearly_summary_report();

?>

<div class="container">
    <div class="content">
        <div class="content-container">
            <div class="content-header">
                <h2 class="content-header-title">Welcome to National Electricity Consumption Information (NECI)</h2>
                <ol class="breadcrumb">
                    <li><a href="./dashboard.php">Dashboard</a></li>
                    <li><a href="javascript:;">MIS Report</a></li>
                    <li class="active">Yearly</li>
                </ol>
            </div>

            <div class="row padnone">
                <div class="col-md-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="align-left">
                            <h4>
                                <a href="#" style="text-decoration:none">
                                    <span class="btn-blue" style="">Yearly Usages Statement</span>
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

                        <form role="form" action="admin_yearly_st.php" method="post">
                            <div class="form-group">
                                <div class="col-md-3 col-sm-12">
                                    <select type="text" name="fyear" class="form-control" id="form-email" required>
                                        <option selected>Select Your Year</option>
                                        <?php
                                        $i=0;
                                        foreach ($allyear as $all_year){
                                            $yrr=$all_year['cyear'];
                                            echo "<option value='".$all_year['cyear']."'>$yrr</option>";

                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <button type="submit" class="btn btn-warning">Submit</button>
                                </div>
                            </div>
                        </form>

                        <br /><br />

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
                                    <th data-filterable="true" data-sortable="true" align="center" >Month</th>
                                    <th align="center">Total Unit (MW)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sl=0;
                                foreach($ySummary as $data){
                                    $sl++;
                                    ?>
                                    <tr>
                                        <td align="left"><?php echo $sl ?></td>
                                        <td align="left"><?php echo $data['nmonth']?></td>
                                        <td align="right"><?php echo $data['stotal']?></td>
                                    </tr>
                                <?php } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
            </div>
        </div>
    </div>
</div>
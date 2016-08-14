<?php


include_once('../../vendor/autoload.php');
use App\Bitm\Consume\Consume;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;
use App\Bitm\District\District;
use App\Bitm\BoardMember\BoardMember;
use  App\Bitm\User\User;
use App\Bitm\Visitor_Message\Vmessage;

session_start();

$data = new Consume();
$allval=$data->summary();
$summary_data=$data->summary_report();
//Utility::dd($summary_data);
//die();

$allcity=$data->getcity();

//////////Start  board Member Count
$boardMember= New BoardMember();
$bm=$boardMember->index_Boardmember();


$totalBmember=$boardMember->count__Boardmember();
//Utility::dd($totalItem);

/////////////End board Member Count


////////////////////for send message
$city=new User();
$alcity=$city->getcity();

////////////////////end send message


?>


<div class="container">
    <div class="content">
        <div class="content-container">
            <div class="content-header">
                <h2 class="content-header-title">Welcome to National Electricity Consumption Information (NECI)</h2>
                <ol class="breadcrumb">
                    <li><a href="./dashboard.php">Dashboard</a></li>
                    <li><a href="javascript:;">MIS Report</a></li>
                    <li class="active">Consumption Summary</li>
                </ol>
            </div> <!-- /.content-header -->

            <div class="row padnone">
                <div class="col-md-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="align-left">
                            <h4>
                                <a href="#" style="text-decoration:none">
                                    <span class="btn-blue" style="">Consumption Summary</span>

                                </a>
                            </h4>
                        </div>

                    </div>
                </div>
            </div><br />


                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4" style="border: 1px solid #fd9e81; border-radius: 5px;padding: 20px;">
                        <label style="color:#653f33;">Last 5 Days Usages Summary</label>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-highlight">
                                <tr style="background: #fed8cc;color:#7e4f40;font-size:15px;">
                                    <th style="...">SL.</th>
                                    <th style="text-align:center;">Date</th>
                                    <th style="text-align:center;">Total Electricity <br>Consumption(MW)</th>
                                </tr>
                                <tr>
                                    <?php
                                    $sum_sl=0;
                                    foreach($allval as $sumData){
                                    $sum_sl++;
                                    ?>
                                <tr class="">
                                    <td align="center"><?php echo $sum_sl ?></td>
                                    <td align="center"><?php echo date('d-M-Y',strtotime($sumData['input_date']))?></td>
                                    <td align="right"><?php echo number_format($sumData['summary'],4)?></td>
                                </tr>
                                <?php } ?>


                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-2"></div>

                    <div class="col-md-4" style="border: 1px solid #0099ff; border-radius: 5px;padding: 20px;">
                        <label style="color:#003d66;">Top 10 District Today <?php echo date('M d, Y')?></label>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-highlight">

                                    <tr style="background: #b8d1fa;color:#1f3861;font-size:15px;">
                                        <th>SL</th>
                                        <th style="text-align:center;">District</th>
                                        <th style="text-align:center;">Etc Power Consume <br /> (MW)</th>
                                    </tr>

                                <?php
                                $sumDetails_sl=0;
                                foreach($summary_data as $data){
                                    $sumDetails_sl++;
                                    ?>
                                    <tr class="">
                                        <td align="center"><?php echo $sumDetails_sl ?></td>
                                        <td align="center"><?php echo $data['district_name']?></td>
                                        <td align="right"><?php echo number_format($data['unit'],4)?></td>
                                    </tr>
                                <?php } ?>

                            </table>
                        </div>
                    </div>


        </div>
        <br />

    </div>

</div>

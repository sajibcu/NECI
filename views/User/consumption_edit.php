<?php
include_once('../../vendor/autoload.php');

use App\Bitm\District\District;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
use App\Bitm\Neci\Neci;
session_start();



$book= new Neci();
$singleItem= $book->prepare($_GET)->view();
?>

<div class="container">
    <div class="content">
        <div class="content-container">
            <div class="content-header">
                <h2 class="content-header-title">Welcome to National Electricity Consumption Information (NECI)</h2>
                <ol class="breadcrumb">
                    <li><a href="./dashboard.php">Dashboard</a></li>
                    <li><a href="javascript:;">Manage</a></li>
                    <li class="active">Add Consumption</li>
                </ol>
            </div> <!-- /.content-header -->

            <div class="row padnone">
                <div class="col-md-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="align-left">
                            <h4>
                                <a href="#" style="text-decoration:none">
                                    <span class="btn-blue" style="">Add Consumption</span>
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div><br />

            <div class="portlet">
                <div class="portlet-header">
                    <h3> <i class="fa fa-calendar"></i>Edit Data</h3>
                </div>
                <!-- /.portlet-header -->
                <div class="portlet-content">
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2"></div>
                    <div class="col-lg-6 col-md-10 col-sm-10 col-xs-10">
                        <div class="ebox">

                            <form role="form" action="../Neci/update.php" method="post">
                                <input type="hidden" name="id"   value="<?php echo $singleItem['id']?>">
                                <div class="row">
                                    <div class="form-group row bo-ac">
                                        <label  class="col-md-4 col-sm-12">Selected Date</label>
                                        <div class="col-md-8 col-sm-12">
                                            <input type="text" name="input_date" class="form-control" id="email" value="<?php echo  $singleItem['input_date']?>" placeholder="Enter disctrict" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="form-group row bo-ac">
                                        <label class="col-md-4 col-sm-14">Edit Consumption</label>
                                        <div class="col-md-8 col-sm-12">
                                            <input type="text" name="unit" class="form-control" id="email" value="<?php echo  $singleItem['unit']?>" placeholder="Enter Unit" required>
                                        </div>
                                    </div>


                                    <!--<div class="form-group">
                                        <label>Enter time</label>
                                        <input type="text" name="input_time" class="form-control" id="email" placeholder="Enter time">
                                    </div>-->


                                    <button type="submit" class="btn btn-info" style="float: right;">Update</button>
                                </div>
                            </form>

                        </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-1 col-sm-1 col-xs-1"></div>

                </div><!-- /.portlet-content -->
            </div>
            <br />

        </div>

    </div>

</div>
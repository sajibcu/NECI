<?php
session_start();
include_once('../../vendor/autoload.php.');
use App\Bitm\Notice\Notice;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;
use App\Bitm\District\District;
$maxsl = new Notice();
//$tmaxsl=$maxsl->sl_count();

$district_nm= new District();
$row = $district_nm->prepare($_GET)->districtnm();
$dis_nm=$row['district_name'];

//Utility::dd($dis_nm);
//die();
?>





<div class="container">
    <div class="content">
        <div class="content-container">
            <div class="content-header">
                <h2 class="content-header-title">Welcome to National Electricity Consumption Information (NECI)</h2>
                <ol class="breadcrumb">
                    <li><a href="./dashboard.php">Dashboard</a></li>
                    <li><a href="javascript:;">MIS Report</a></li>
                    <li class="active">Add Notice</li>
                </ol>
            </div> <!-- /.content-header -->

            <div class="row padnone">
                <div class="col-md-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="align-left">
                            <h4>
                                <a href="#" style="text-decoration:none">
                                    <span class="btn-blue" style="">Add Notice</span>
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div><br />

            <div class="portlet">
                <div class="portlet-header">
                    <h3> <i class="fa fa-calendar"></i>Add Notice Details</h3>
                </div>
                <!-- /.portlet-header -->
                <div class="portlet-content">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <div class="">

                            <br>
                            <div id="message">
                                <?php  if ((array_key_exists('message',$_SESSION)&&!empty($_SESSION['message']))){
                                    echo Message::message();
                                }
                                ?>
                            </div>

                        <br>
                        <div id="message">
                            <?php  if ((array_key_exists('message',$_SESSION)&&!empty($_SESSION['message']))){
                                echo Message::message();
                            }
                            ?>
                        </div>
                                        <form role="form" action="../Notice/store.php" method="post">

                                            <div class="form-group has-default">
<!--                                                <label for="name">District Code</label>-->
<!--                                                <div class="input-group">-->
<!--                                                    <div class="input-group-addon"><i class='fa fa-tint'></i></div>-->
                                                    <input type="hidden" id="packagename" name="district_cd" value="<?php echo $_SESSION['district'] ?>" >
<!--                                                </div>-->
                                            </div>
                                            <div class="form-group">
                                                <label for="date-2">Notice Date</label>
                                                <div class="input-group date ui-datepicker" data-date-format="yyyy-mm-dd">
                                                    <input id="date-2" name="notice_date" class="form-control" type="text" data-required="true">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <span class="help-block">yyyy-mm-dd</span>
                                            </div>
                                            <div class="form-group has-default">
                                                <label for="name">District </label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class='fa fa-tint'></i></div>
                                                    <input type="text" name="" class="form-control" id="email" value="<?php echo $dis_nm?>" placeholder="" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group has-default">
                                                <label for="name">User ID</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class='fa fa-tint'></i></div>
                                                    <input type="text" id="packagename" name="user_id" placeholder="User ID"  VALUE="<?PHP echo $userid?>" class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group has-default">
                                                <label for="name">Notice Title</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class='fa fa-tint'></i></div>
                                                    <input type="text" id="packagename" name="notice_title" placeholder="Notice Title" class="form-control" required="true">
                                                </div>
                                            </div>



                                            <div class="form-group has-default">
                                                <label for="name">Notice Content</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class='fa fa-indent'></i></div>
                                                    <textarea name="notice_content" class="form-control" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                    </form>
                </div>

            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>

        </div><!-- /.portlet-content -->
    </div>
    <br />

</div>

</div>

<script>
    $('#message').show().delay(3000).fadeOut();
</script>

</div>
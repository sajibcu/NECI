<?php

if(!isset($_SESSION))
{
    session_start();
}
include_once('../../vendor/autoload.php');
use App\Bitm\Utility\Utility;
use App\Bitm\User\User;
use App\Bitm\District\District;


$user=new User();
$user->prepare($_SESSION);
$userInfo=$user->getInfo();

$district=new District();
$userDistrict=$district->prepare($_SESSION)->districtnm();
//Utility::dd($userInfo);

$city=new District();
$alcity=$city->index();

?>

<div class="container">
    <div class="content">
        <div class="content-container">
            <div class="content-header">
                <h2 class="content-header-title">Welcome to National Electricity Consumption Information (NECI)</h2>
                <ol class="breadcrumb">
                    <li><a href="./dashboard.php">Dashboard</a></li>
                    <li><a href="javascript:;">Manage</a></li>
                    <li class="active">Profile</li>
                </ol>
            </div> <!-- /.content-header -->

            <div class="row padnone">
                <div class="col-md-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="align-left">
                            <h4>
                                <a href="#" style="text-decoration:none">
                                    <span class="btn-blue" style="">Profile Update</span>
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div><br />

            <div class="portlet">
                <div class="portlet-header">
                    <h3> <i class="fa fa-calendar"></i>Profile Update</h3>
                </div>
                <!-- /.portlet-header -->
                <div class="portlet-content">
                    <div class="col-lg-3 col-md-1 col-sm-1 col-xs-1"></div>
                    <div class="col-lg-6 col-md-10 col-sm-10 col-xs-10">
                        <div class="ebox">

                            <br>
                            <div id="message">
                                <?php  if ((array_key_exists('message',$_SESSION)&&!empty($_SESSION['message']))){
                                    echo Message::message();
                                }
                                ?>
                            </div>


    <form role="form" action="Update.php" method="post" class="registration-form">


        <div class="form-group">
            <label style="color: #b81900">First name</label>
            <input type="text" name="first_name" value="<?php echo $userInfo['first_name']?>" class="form-email form-control" id="form-email">
        </div>

        <div class="form-group">
            <label style="color: #b81900">Last name</label>
            <input type="text" name="last_name" value="<?php echo $userInfo['last_name']?>" class="form-email form-control" id="form-email">
        </div>

        <div class="form-group">
            <label style="color: #b81900">Phone</label>
            <input type="text" name="phone_no" value="<?php echo $userInfo['phone_no']?>" class="form-email form-control" id="form-email">
        </div>

        <div class="form-group">
            <label style="color: #b81900">Designation</label>
            <input type="text" name="designation" value="<?php echo $userInfo['designation']?>" class="form-email form-control" id="form-email">
        </div>

        <div class="form-group">
            <label class="sr-only" for="form-email">Phone</label>
            <select  type="text" name="city" class="form-email form-control" id="form-email" required>
                <?php
                echo "<option selected value=\"".$userInfo['district_cd']."\">".$userDistrict['district_name']."</option>";
                $i=0;
                foreach ($alcity as $city){
                    echo "<option value=\"".$city['district_cd']."\">".$city['district_name']."</option>";
                }
                ?>
            </select>
        </div>


        <button type="submit" class="btn btn-warning">Update</button>
    </form>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-1 col-sm-1 col-xs-1"></div>

                </div><!-- /.portlet-content -->
            </div>
            <br />

        </div>

    </div>

    <script>
        $('#message').show().delay(3000).fadeOut();
    </script>

</div>
<?php

include_once ('../../vendor/autoload.php');
use App\Bitm\District\District;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

session_start();

$district_nm= new District();
$row = $district_nm->prepare($_GET)->districtnm();
$dis_nm=$row['district_name'];


//	if ($row == true) {
//
//      $_SESSION['id']			=$row['id'];
//		$_SESSION['user_id'] 	=$row['user_id'];
//		$_SESSION['email']  	=$row['email'];
//		$_SESSION['level']  	=$row['role'];
//		$_SESSION['status']		=$row['status'];
//		$_SESSION['district']	=$row['district_cd'];


// ($district_nm_x);
//Utility::dd($row);
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
          <h3> <i class="fa fa-calendar"></i>Add Consumption Details</h3>
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


							<form role="form" action="../Neci/store.php" method="post">
								<div class="row">
									<div class="form-group row bo-ac">
										<label  class="col-md-4 col-sm-12">District ID</label>
										<div class="col-md-8 col-sm-12">
											<input type="text" name="district_cd" class="form-control" id="email" value="<?php echo $district?>" placeholder="Enter disctrict" readonly="readonly">
										</div>
									</div>

									<div class="form-group row bo-ac">
										<label  class="col-md-4 col-sm-12">District Name</label>
										<div class="col-md-8 col-sm-12">
											<input type="text" name="" class="form-control" id="email" value="<?php echo $dis_nm?>" placeholder="" readonly="readonly">
										</div>
									</div>


									<div class="form-group row bo-ac">
										<label class="col-md-4 col-sm-12">User ID</label>
										<div class="col-md-8 col-sm-12">
											<input type="text" name="user_id" class="form-control" id="email" VALUE="<?PHP echo $userid?>" placeholder="Enter user" readonly="readonly">
										</div>
									</div>

									<div class="form-group row bo-ac">
										<label class="col-md-4 col-sm-12">Date</label>
										<div class="col-md-8 col-sm-12">
											<input type="text" name="input_date" class="form-control" id="email" value="<?php echo strtoupper(date('Y-m-d')) ?>" placeholder="<?php echo strtoupper(date('d-M-Y')) ?>" readonly="readonly">
										</div>
									</div>

									<div class="form-group row bo-ac">
										<label class="col-md-4 col-sm-12">Enter Consumption(MW)</label>
										<div class="col-md-8 col-sm-12">
											<input type="text" name="unit" class="form-control" id="email" placeholder="Enter Unit" required>
										</div>
									</div>


									<!--<div class="form-group">
                                        <label>Enter time</label>
                                        <input type="text" name="input_time" class="form-control" id="email" placeholder="Enter time">
                                    </div>-->


									<button type="submit" class="btn btn-info" style="float: right;">Submit</button>

								</div>
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
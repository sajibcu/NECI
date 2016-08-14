<?php
session_start();
include_once('../../vendor/autoload.php');
use App\Bitm\Neci\Neci;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;
use App\Bitm\District\District;



$district_nm= new District();
$row = $district_nm->prepare($_GET)->districtnm();
$dis_nm=$row['district_name'];

$book= new Neci();
$trasc=$book->trashedcount();
$totalItem=$book->count();
//Utility::dd($totalItem);


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
  $pagination.="<li class='$active'><a href='dashboard.php?pageNumber=$i'>$i</a></li>";
}

$pageStartFrom=$itemPerPage*($pageNo-1);

$allval=$book->prepare($_POST)->paginator($pageStartFrom,$itemPerPage);
$prev=$pageNo-1;
$next=$pageNo+1;
//Utility::dd($pagination);
//die();



?>

<div class="container">
  <div class="content">
    <div class="content-container">
      <div class="content-header">
        <h2 class="content-header-title">Welcome to National Electricity Consumption Information (NECI)</h2>
      </div>

  		<div class="row padnone">
				<div class="col-md-12">
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="align-left">
							<h4>
								<a href="#" style="text-decoration:none">
									<span class="btn-blue" style="">Dashboard</span>
								</a>
							</h4>
						</div>
					</div>
					<div class="col-md-8 col-sm-6 col-xs-12">
						<div class="cdetails align-left" style="color: #A47641;">
							<h2>Yearly Consumption Chart</h2>
						</div>
					</div>
				</div>
  		</div>



<!--    <div class="row">-->
		
			<?php
			if ($_SESSION['role']==1) {
				?>
				<div id="message">

					<?php  if ((array_key_exists('message',$_SESSION)&&!empty($_SESSION['message']))){
						echo Message::message();
					}
					?>
				</div>

				<br />
				<div class="row">
					<iframe
						src="chart/usages_unit_summary.php"
						width="100%"
						scrolling="no"
						id="the_iframe"

						height="500px"
						frameborder="0"
					>
					</iframe>
				</div>
			<?php
			}
			elseif ($_SESSION['role']==2) {
			?>
			
<!-- <div class="container"> -->



	  <div id="message">

	  <?php  if ((array_key_exists('message',$_SESSION)&&!empty($_SESSION['message']))){
		echo Message::message();
	  }
	  ?>
	  </div>

		<br />
		<div class="row">
			<iframe
				src="chart/usages_unit_summary.php"
				width="100%"
				scrolling="no"
				id="the_iframe"

				height="500px"
				frameborder="0"
			>
			</iframe>

<!--			<div class="col-md-1 col-sm-1 col-xs-1"></div>-->
<!--			<div class="col-lg-12 col-md-10 col-sm-10 col-xs-10">-->
<!--				<div class=""><!-- ebox-->

<!--					<label for="sel1">Select Item Per Page (select one):</label>-->
<!---->

<!---->
<!--					<div class="table-responsive">-->
<!---->
<!--						<table-->
<!--							class="table table-striped table-bordered table-hover table-highlight table-checkable"-->
<!--							data-provide="datatable"-->
<!--							data-search="false"-->
<!--							data-length-change="true"-->
<!--						>-->
<!--							<thead>-->
<!--								<tr class="">-->
<!--									<th data-filterable="true" data-sortable="true" style="text-align:left;">SL</th>-->
<!--									<th data-filterable="true" data-sortable="true" style="text-align:left;">ID</th>-->
<!--									<th data-filterable="true" data-sortable="true" style="text-align:center;">District</th>-->
<!--									<th data-filterable="true" data-sortable="true" style="text-align:center;">User ID</th>-->
<!--									<th data-filterable="true" data-sortable="true" style="text-align:center;">Input Date</th>-->
<!--									<th data-filterable="true" data-sortable="true" style="text-align:right;">Consumption Unit</th>-->
<!--									<th style="text-align:center;">Action</th>-->
<!--								</tr>-->
<!--							</thead>-->
<!--							<tbody>-->
<!--							--><?php
//							$sl=0;
//							foreach($allval as $data){
//									$sl++;
//									?>
<!--								<tr class="">-->
<!--									<td>--><?php //echo $sl+$pageStartFrom ?><!--</td>-->
<!--									<td>--><?php //echo $data['id']?><!--</td>-->
<!--									<td align="center" width="">--><?php //echo $dis_nm ?><!--</td>-->
<!--									<td align="center" width="">--><?php //echo $data['user_id']?><!--</td>-->
<!--									<td align="center" width="">--><?php //echo strtoupper(date('d-M-Y',strtotime($data['input_date'])))?><!--</td>-->
<!--									<td align="right" width="">--><?php //echo $data['unit']?><!--</td>-->
<!--									<td width="12%">-->
<!--<!--											<a href="#" class="btn btn-warning btn-xs" role="button">View</a>-->
<!--											<a href="edit_consumption.php?id=--><?php //echo $data['id']?><!--" class="btn btn-info btn-xs" role="button">Edit</a>-->
<!---->
<!---->
<!--										--><?php
//										if ($_SESSION['role']==1) {echo '<a href="../Neci/delete.php?id=" class="btn btn-danger btn-xs" role="button">Delete</a>';}else {echo "";} ?>
<!---->
<!---->
<!--<!--										<a href="#" class="btn btn-success btn-xs" role="button">Trash</a>-->
<!--									</td>-->
<!--								</tr>-->
<!--							--><?php //} ?>
<!--							</tbody>-->
<!--<!--						</table>-->
<!--						</table>-->
<!--						<ul class="pagination">-->
<!--							--><?php //if($pageNo>1) {echo "<li><a href='dashboard.php?pageNumber=$prev'>Prev</a></li>";}else{echo "";}?>
<!--							--><?php //echo $pagination?>
<!--							--><?php //if($pageNo<$noOfPage){echo "<li><a href='dashboard.php?pageNumber=$next'>Next</a></li>";}else{echo "";}?>
<!--						</ul>-->
<!---->
<!--						<br />-->
<!--<!--						<a href="consumption_add.php" class="btn btn-info" role="button">Add Consumption</a>&nbsp;-->
<!--						<a href="pdf.php" class="btn btn-info" role="button">Download as PDF</a>&nbsp;-->
<!--						<a href="xls.php" class="btn btn-info" role="button">Download as XL</a>&nbsp;-->
<!--						<a href="mail.php" class="btn btn-info" role="button">Send Mail</a>-->
<!---->
<!--				</div>-->
<!--			 </div>-->
<!--			</div>-->
<!--			<div class="col-md-1 col-sm-1 col-xs-1"></div>-->

			<?php
			}
			?>
    </div>
  </div> 
</div>

	<script>
		$('#message').show().delay(3000).fadeOut();
	</script>
</div>
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
$totalItem=$data->prepare($_GET)->count_index();
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
  $pagination.="<li class='$active'><a href='index.php?pageNumber=$i'>$i</a></li>";
}

$pageStartFrom=$itemPerPage*($pageNo-1);

$allBook=$data->prepare($_GET)->paginator_index($pageStartFrom,$itemPerPage);
//Utility::dd($allBook);
//die();
$prev=$pageNo-1;
$next=$pageNo+1;
//$disnm=$data->districtnm();
//Utility::dd($disnm);
//die();
?>

<?php
include './header_main.php';
?>
<body class="framePage">

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-warning navbar-custom navbar-fixed-top" style="background: #000;">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">NECI</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="activex">
                    <a class="page-scroll" href="../../index.php">Home</a>
                </li>

                

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>


<div class="container" style="margin-top:100px;">
    <div class="content">
    <div class="content-container">
<h3 style="text-align: center; color: #761c19 "> Usages of Electricity on Current Date</h3>


            <br />
          <div id="message">

          <?php  if ((array_key_exists('message',$_SESSION)&&!empty($_SESSION['message']))){
            echo Message::message();
          }
          ?>
          </div>

                    <form role="form" action="index.php">
                      <div class="form-group">
                        <label for="sel1">Select Item Per Page Record (select one):</label>
                                      <select class="form-control" id="sel1" name="itemPerPage" style="width:auto;">
                                        <option <?php if($_SESSION['itemPerPage']==5) {echo "selected";}?>>5</option>
                                        <option <?php if($_SESSION['itemPerPage']==10) {echo "selected";}?>>10</option>
                                        <option <?php if($_SESSION['itemPerPage']==15) {echo "selected";}?>>15</option>
                                        <option <?php if($_SESSION['itemPerPage']==20) {echo "selected";}?>>20</option>
                                        <option <?php if($_SESSION['itemPerPage']==25) {echo "selected";}?>>25</option>
                                        <option <?php if($_SESSION['itemPerPage']==65) {echo "selected";}?>>65</option>
                                      </select>

                          <button type="submit">Submit</button>

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
                <th>ID</th>
                <th align="center">Date</th>
                <th data-filterable="true" data-sortable="true" align="right">District Name</th>
                <th align="center">Usages (MW)</th>
               </tr>
            </thead>
            <tbody>
            <?php
            $sl=0;
            foreach($allBook as $data){
               
                $sl++;
                ?>
              <tr>
                <td align="left"><?php echo $sl+$pageStartFrom ?></td>
                <td align="left"><?php echo $data['id'] // for object: $book->id ; ?></td>
                <td align="center"><?php  echo date('d-M-Y',strtotime($data['input_date']))?></td>
                <td align="center"><?php  echo $data['district_name'] // for object: $book->title; ?></td>
                <td align="right"><?php echo $data['unit'] // for object: $book->title; ?></td>
              </tr>
            <?php } ?>


            </tbody>
          </table>
              <ul class="pagination">
                <?php if($pageNo>1) {echo "<li><a href='index.php?pageNumber=$prev'>Prev</a></li>";}else{echo "";}?>
                <?php echo $pagination?>
                <?php if($pageNo<$noOfPage){echo "<li><a href='index.php?pageNumber=$next'>Next</a></li>";}else{echo "";}?>
              </ul>

                <table class="table">
                    <thead>
                    <tr class="success">
<!--                        <a href="pdf.php" class="btn btn-info" role="button">Download as PDF</a>&nbsp;-->
<!--                        <a href="xls.php" class="btn btn-info" role="button">Download as XL</a>&nbsp;-->
                    </tr>
                    </thead>
                </table>

          </div>
        </div>
    </div>
</div>

<?php
include './footer_main.php';
?>


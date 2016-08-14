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
    $pagination.="<li class='$active'><a href='daily_st.php?pageNumber=$i'>$i</a></li>";
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

<?php
include './header_main.php';
?>
<body class="framePage">
<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-warning navbar-custom navbar-fixed-top" style="background: #000; ">
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




    <div class="container" style="padding-top: 60px;width: 1000px "; >
        <div class="content">
            <div class="content-container">
                <h3 style="text-align: center; color: #761c19 ">Usages of Electricity on Date to Date</h3>
                <h2><?php echo date('Y-m-d')  ?></h2>
                <div id="message">
                    <?php  if ((array_key_exists('message',$_SESSION)&&!empty($_SESSION['message']))){
                        echo Message::message();
                    }
                    ?>
                </div>

    <form role="form" action="daily_st.php" >
        <div class="row">
        <div class="form-group">
            
            <label for="sel1">Select Item Per Page Record (select one):</label>
            <select class="form-control" id="sel1" name="itemPerPage" style="width:auto;">
                <option <?php if($_SESSION['itemPerPage']==5) {echo "selected";}?>>5</option>
                <option <?php if($_SESSION['itemPerPage']==10) {echo "selected";}?>>10</option>
                <option <?php if($_SESSION['itemPerPage']==15) {echo "selected";}?>>15</option>
                <option <?php if($_SESSION['itemPerPage']==20) {echo "selected";}?>>20</option>
                <option <?php if($_SESSION['itemPerPage']==25) {echo "selected";}?>>25</option>
                <option <?php if($_SESSION['itemPerPage']==65) {echo "selected";}?>>65</option>
            <!--                          </div>-->

                
            </select>
            <div>

            <div class="form-group">
                <label class="col-md-2 col-sm-12">From Date</label>
                <div class="col-md-3 col-sm-12">
                    <input type="date" name="fdate" class="form-control datepicker"  id="email" value="<?php echo  $_SESSION['fdate'] ?>" >
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-2 col-sm-12">To Date</label>
                <div class="col-md-3 col-sm-12">
                    <input type="date" name="tdate" class="form-control datepicker"  id="email" value="<?php echo  $_SESSION['tdate'] ?>"" >
                </div>
            </div>


            <div>
                <button type="submit" class="btn btn-warning">Submit</button>
            </div>
                </div>
    </form>

    <div class="table-responsive">
        <table class="table" style="width: 100%">
            <thead>
            <tr>
                <th width="20px">SL</th>
<!--                <th width="20px">ID</th>-->
                <th width="20px" align="center">Date</th>
                <th width="20px" align="left">District Name</th>
                <th width="30px" align="right">Usages (MW)</th>
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
                    <td width="20px"align="left"><?php echo $sl+$pageStartFrom ?></td>

                    <td width="20px"align="center"><?php  echo date('d-M-Y',strtotime($data['input_date']))?></td>
                    <td width="20px" align="left"><?php  echo $disnm['district_name'] // for object: $book->title; ?></td>
                    <td width="30px" align="right"><?php echo $data['unit'] // for object: $book->title; ?></td>
                </tr>
            <?php } ?>


            </tbody>
        </table>
        <ul class="pagination">
            <?php if($pageNo>1) {echo "<li><a href='daily_st.php?pageNumber=$prev'>Prev</a></li>";}else{echo "";}?>
            <?php echo $pagination?>
            <?php if($pageNo<$noOfPage){echo "<li><a href='daily_st.php?pageNumber=$next'>Next</a></li>";}else{echo "";}?>
        </ul>

<!--        <table class="table">-->
<!--            <thead>-->
<!--            <tr class="success">-->
<!--                <a href="pdf.php" class="btn btn-info" role="button">Download as PDF</a>&nbsp;-->
<!--                <a href="xls.php" class="btn btn-info" role="button">Download as XL</a>&nbsp;-->
<!--            </tr>-->
<!--            </thead>-->
<!--        </table>-->

    </div>
</div>
</div>
</div>


<?php
include './footer_main.php';
?>

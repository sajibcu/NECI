<?php
session_start();
include_once('../../vendor/autoload.php.');
use App\Bitm\Neci\Neci;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;


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
    $pagination.="<li class='$active'><a href='dash.php?pageNumber=$i'>$i</a></li>";
}

$pageStartFrom=$itemPerPage*($pageNo-1);

$allBook=$book->paginator($pageStartFrom,$itemPerPage);
$prev=$pageNo-1;
$next=$pageNo+1;
?>


<div class="container">
    <div class="content">
        <div class="content-container">
            <div class="content-header">
                <h2 class="content-header-title">Welcome to National Electricity Consumption Information (NECI)</h2>
            </div>

            <div class="row padnone" style="padding-top: 3px">
                <div class="col-md-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="align-left">
                            <h4>
                                <a href="#" style="text-decoration:none">
                                    <span class="btn-blue" style="">Dashboard</span>
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>

<!--                <div class="row">-->
<!--                    --><?php
//                    if ($_SESSION['level']==1) {
//                        echo "<div class='col-md-12'>
//								<h4>Welcome to admin panel</h4>
//							</div>";
//                    }
//                    elseif ($_SESSION['level']==2) {
//                        echo "<div class='col-md-12'>
//								<h4>Welcome to user panel</h4>
//							</div>";
//                    }
//                    ?>
<!--                </div>-->

            </div>
            <br />

            <!------------->

            <!DOCTYPE html>
            <html>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
                <link rel="stylesheet" type="text/css" href="../../Resources/bootstrap/css/bootstrap.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
                <!--  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
            </head>
            <body>

            <!--		<div class="container">-->
            <!--			<li><a href="../User/dashboard.php">Dashboard</a></li>-->
            <!--			<div class="page-header" align="center">-->
            <!--				<h2>Consumption Details</h2>-->
            <!--			</div>-->
            <table class="table">
                <thead>
                <tr class="success">
                    <!--					<a href="../../../index.php" class="btn btn-success" role="button">Home</a>-->
                    <!--					&nbsp;-->
                    <!--					<a href="create.php" class="btn btn-info" role="button">Add Consumption</a>-->
                    <!--					&nbsp;-->
                    <!--					<a href="trashed_view.php" class="btn btn-danger" role="button">Trashed List --><?php //if(!empty($trasc)) {echo '('.$trasc.')';} else{"";} ?><!--</a>-->
                    <!--					&nbsp;-->
                    <a href="pdf.php" class="btn btn-info" role="button">Download as PDF</a>
                    &nbsp;
                    <a href="xls.php" class="btn btn-info" role="button">Download as XL</a>
                    &nbsp;
                    <a href="mail.php" class="btn btn-info" role="button">Send Mail</a>
                </tr>
                </thead>
            </table>
            <div id="message">

                <?php  if ((array_key_exists('message',$_SESSION)&&!empty($_SESSION['message']))){
                    echo Message::message();
                }
                ?>
            </div>

            <form role="form" action="dash.php">
                <div class="form-group">
                    <label for="sel1">Select Item Per Page Record (select one):</label>
                    <select class="form-control" id="sel1" name="itemPerPage" style="width:auto;">
                        <option <?php if($_SESSION['itemPerPage']==5) {echo "selected";}?>>5</option>
                        <option <?php if($_SESSION['itemPerPage']==10) {echo "selected";}?>>10</option>
                        <option <?php if($_SESSION['itemPerPage']==15) {echo "selected";}?>>15</option>
                        <option <?php if($_SESSION['itemPerPage']==20) {echo "selected";}?>>20</option>
                        <option <?php if($_SESSION['itemPerPage']==25) {echo "selected";}?>>25</option>
                    </select>
                    <button type="submit">Submit</button>
                    <br>

            </form>

            <div class="portlet">
                <div class="portlet-header">
                    <h3><i class="fa fa-calendar"></i>Consumption Details</h3>
                </div> <!-- /.portlet-header -->
                <div class="portlet-content">
                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1"></div>
                    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">
                        <div class="ebox">
                            <div class="table-responsive">
                                <table class="table" style="width: 100%">
                                    <thead>
                                    <tr class="success">
                                        <th>SL</th>
                                        <th>ID</th>
                                        <th>District</th>
                                        <th>User Id</th>
                                        <th>Input Date</th>
                                        <th>Consumption <br> Unit</th>

                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sl=0;
                                    foreach($allBook as $data){
                                        $sl++;
                                        ?>
                                        <tr class="info">
                                            <td><?php echo $sl+$pageStartFrom ?></td>
                                            <td><?php echo $data['id'] // for object: $book->id ; ?></td>
                                            <td width="20%"><?php echo $data['district_cd'] // for object: $book->title; ?></td>
                                            <td width="10%"><?php echo $data['user_id'] // for object: $book->title; ?></td>
                                            <td align="right" width="10%"><?php echo $data['input_date'] // for object: $book->title; ?></td>
                                            <td  align="right" width="10%"><?php echo $data['unit'] // for object: $book->title; ?></td>
                                            <td>
                                                <a href="view.php?id=<?php echo $data['id']?>" class="btn btn-info  btn-xs" role="button">View</a>
                                                <a href="../Neci/edit.php?id=<?php echo $data['id']?>" class="btn btn-primary  btn-xs" role="button">Edit</a>
                                                <a href="delete.php?id=<?php echo $data['id']?>" class="btn btn-danger  btn-xs" role="button">Delete</a>
                                                <a href="trash.php?id=<?php echo $data['id']?>" class="btn btn-info  btn-xs" role="button">Trash</a>
                                            </td>


                                        </tr>
                                    <?php } ?>


                                    </tbody>
                                </table>
                                <ul class="pagination">
                                    <?php if($pageNo>1) {echo "<li><a href='index.php?pageNumber=$prev'>Prev</a></li>";}else{echo "";}?>
                                    <?php echo $pagination?>
                                    <?php if($pageNo<$noOfPage){echo "<li><a href='index.php?pageNumber=$next'>Next</a></li>";}else{echo "";}?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--		</div>-->
            <script>
                $('#message').show().delay(3000).fadeOut();
            </script>

            </body>
            </html>

            <!-------------------------------------------------------------->



        </div>
    </div>
</div>








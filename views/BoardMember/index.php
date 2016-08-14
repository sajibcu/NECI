<?php

include_once('../../vendor/autoload.php');

use App\Bitm\BoardMember\BoardMember;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;


session_start();
$boardMember= New BoardMember();
$bm=$boardMember->index_Boardmember();


$totalBmember=$boardMember->count__Boardmember();
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
$noOfPage= ceil($totalBmember/$itemPerPage);

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

$allmember=$boardMember->prepare($_POST)->paginator__Boardmember($pageStartFrom,$itemPerPage);
//Utility::d($allmember);
//die();
$prev=$pageNo-1;
$next=$pageNo+1;
/////////////End board Member Count

?>

<?php
include '../Consume/header_main.php';
?>
<body>


<div class="container" style="margin-top:50px;">
    <div class="content">
        <div class="content-container">
            <h3 style="text-align: center; color: #761c19 ">District Chief List</h3>


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
                        <th data-filterable="true" data-sortable="true" align="center">District Name</th>
                        <th data-filterable="true" data-sortable="true" align="right">Board Member Name</th>
                        <th data-filterable="true" data-sortable="true" style="text-align:center;">Designation</th>
                        <th data-filterable="true" data-sortable="true" style="text-align:center;">Phone No</th>
                        <th data-filterable="true" data-sortable="true" style="text-align:center;">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sl=0;
                    foreach($allmember as $data){
                        $bfullnm=$data['first_name'].'&nbsp;'.$data['last_name'];
                        $sl++;
                        ?>
                        <tr>
                            <td align="center"><?php echo $sl+$pageStartFrom ?></td>
                            <td align="center"><?php echo $data['district_name']?></td>
                            <td align="center"><?php echo $bfullnm?></td>
                            <td align="center"><?php echo $data['designation']?></td>
                            <td align="center"><?php echo $data['phone_no']?></td>
                            <td align="center"><?php echo $data['email']?></td>
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

<?php
include '../Consume/footer_main.php';
?>


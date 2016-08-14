<?php

include_once('../../vendor/autoload.php');
use App\Bitm\Consume\Consume;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;
session_start();



$data = new Consume();
//$alcity=$data->getcity();
$allyear=$data->getYear();

//if(array_key_exists('fyear',$_SESSION)){
//   if(array_key_exists('fyear',$_GET)){
//        $_SESSION['fyear']=$_GET['fyear'];
//    }
//}
//else{
//    $_SESSION['fyear']= date();
//}
//$fyear=$_SESSION['fyear'];

$ySummary = $data->prepare($_POST)->yearly_summary_report();

?>

<?php
include 'header_main.php';
?>
<body class="framePage">
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
                          <h3 style="text-align: center; color: #761c19 "> Usages of Electricity on Yearly</h3>
                          <h2><?php echo date('Y-m-d')  ?></h2>
                            <div id="message">
                                <?php  if ((array_key_exists('message',$_SESSION)&&!empty($_SESSION['message']))){
                                    echo Message::message();
                                }
                                ?>
                            </div>
                            <form role="form" action="yearly_st.php" method="post">
                                <div class="form-group">
                                    <div class="col-md-3 col-sm-12">
                                       <select  type="text" name="fyear" class="form-email form-control" id="form-email" required>
                                            <option selected>Select Your Year</option>
                                            <?php
                                            $i=0;
                                            foreach ($allyear as $all_year){
                                                $yrr=$all_year['cyear'];
                                                echo "<option value='".$all_year['cyear']."'>$yrr</option>";

                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <button type="submit" class="btn btn-warning">Submit</button>
                                    </div>
                                </div>
                            </form>
                          <br /><br />

                            <div class="table-responsive">
                                <table
                                    class="table table-striped table-bordered table-hover table-highlight table-checkable table-center"
                                    data-provide="datatable"
                                    data-search="false"
                                    data-length-change="true"
                                >

                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th data-filterable="true" data-sortable="true" align="center" >Month</th>
                                        <th align="center">Total Usages Unit (MW)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sl=0;
                                    foreach($ySummary as $data){
                                         $sl++;
                                        ?>
                                        <tr>
                                            <td align="left"><?php echo $sl ?></td>
                                            <td align="left"><?php echo $data['nmonth']?></td>
                                            <td align="right"><?php echo $data['stotal']?></td>
                                        </tr>
                                    <?php } ?>


                                    </tbody>
                                </table>
                            </div>
                      </div>
                  </div>
              </div>
<?php
include './footer_main.php';
?>


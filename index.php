<?php


include_once('vendor/autoload.php');
use App\Bitm\Consume\Consume;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;
use App\Bitm\District\District;
use App\Bitm\BoardMember\BoardMember;
use  App\Bitm\User\User;
use App\Bitm\Visitor_Message\Vmessage;
use App\Bitm\Notice\Notice;
if(!isset($_SESSION)) {
    session_start();
}

$data = new Consume();
$allval=$data->summary();
$summary_data=$data->summary_report();
//Utility::dd($summary_data);
//die();
//for notice section

$disname=new District();
$notice=new Notice();
$allnotice=$notice->display();
$allnoticeString="";
foreach($allnotice as $noticedata)
{
    $dis_name_for_string=$disname->prepare($noticedata)->districtname();
    $allnoticeString.=$dis_name_for_string['district_name'].": ";
    $allnoticeString.=$noticedata['notice_content']."   ";
    $allnoticeString.="</br></br>";

}
//Utility::dd($allnoticeString);


//end notice

$allcity=$data->getcity();

//////////Start  board Member Count
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


////////////////////for send message
$city=new User();
$alcity=$city->getcity();

////////////////////end send message


?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NECI</title>

    <!-- Bootstrap Core CSS -->
    <link href="./neci/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./neci/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="./neci/css/agency.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-warning navbar-custom navbar-fixed-top">
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
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="#dashborad">Dashboard</a>
                </li>
                <!-- <li>
                     <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">More Information
                         <span class="caret"></span>
                       </button>
                       <a class="page-scroll" href="#">More Information</a>

                          <ul class="dropdown-menu">
                           <li><a href="#">HTML</a></li>
                           <li><a href="#">CSS</a></li>
                           <li><a href="#">JavaScript</a></li>
                         </ul>
                     </div>
                     </li> -->




                <li>
                    <a class="page-scroll" href="#moreinfo">More Information</a>
<!--                    <ul class="dropdown-menu">-->
<!--                        <li><a href="#">My District</a></li>-->
<!--                        <li><a href="#">Yearly Statement</a></li>-->
<!--                        <li><a href="#">Monthly Statement</a></li>-->
<!--                        <li><a href="#">Graph</a></li>-->
<!--                    </ul>-->
                </li>

                <li>
                    <a class="page-scroll" href="#about">About us</a>
                </li>




                <li>
                    <a class="page-scroll" href="#boardMember">District Chief</a>
                </li>

                <li>
                    <a class="page-scroll" href="#team">Team</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Contact</a>
                </li>
                <li>
                    <a class="page-scroll" href="./views/User/Signup.php">SignUp/Login</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Header -->
<header>
    <div class="container">
        <div class="intro-text">
            <div id="message">
                <?php  if ((array_key_exists('message',$_SESSION)&&!empty($_SESSION['message']))){
                    echo Message::message();
                }
                ?>
            </div>
            <div class="row">
                <div class="col-md-12 backg">
            <div class="intro-lead-in">Welcome To <br>National Electricity Consumption Information</div>
            <div class="intro-heading">It's Nice To Meet You</div>
            <a href="#dashborad" class="page-scroll btn btn-xl">Tell Me More</a>

        <div class="col-md-10">
        <div class="right-txt">
          <marquee behavior="scroll" direction="up" onMouseOver="this.setAttribute('scrollamount', 0, 0);this.stop();" OnMouseOut="this.setAttribute('scrollamount', 2, 0);this.start();" height="100px" scrollamount="1">
            <p style="font-size:15px; color: yellow">
                <span style="border-bottom:1px solid #F93346;padding:5px 0px;margin:5px 0px;">Notice for today:</span><br><br>
                <span><?php echo $allnoticeString ?></span>
            </p>
        </marquee>

                        </div>
                    </div>





        </div>
    </div>
    </div>
    </div>


</header>

<!-- Services Section -->
<section id="dashborad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Dashboard</h2>
                <h3 style="font-size: x-large " class="section-subheading text-muted">Usages of Electricity in Bangladesh</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4" style="border: 1px solid #fd9e81; border-radius: 5px;padding: 20px;">
                <label style="color:#653f33;">Last 5 Days Usages Summary</label>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-highlight">
                        <tr style="background: #fed8cc;color:#7e4f40">
                            <th style="...">SL.</th>
                            <th style="text-align:center;">Date</th>
                            <th style="text-align:center;">Total Electricity <br>Consumption(MW)</th>
                        </tr>
                        <tr>
                            <?php
                            $sum_sl=0;
                            foreach($allval as $sumData){
                            $sum_sl++;
                            ?>
                        <tr class="">
                            <td align="center"><?php echo $sum_sl ?></td>
                            <td align="center"><?php echo date('d-M-Y',strtotime($sumData['input_date']))?></td>
                            <td align="right"><?php echo number_format($sumData['summary'],4)?></td>
                        </tr>
                        <?php } ?>


                        </tr>
                    </table>
                </div>
            </div>

            <div class="col-md-2"></div>

            <div class="col-md-4" style="border: 1px solid #0099ff; border-radius: 5px;padding: 20px;">
                <label style="color:#003d66;">Top 10 District Today <?php echo date('M d, Y')?></label>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-highlight">
                        <thead>
                            <tr style="background: #b8d1fa;color:#1f3861">
                                <th>SL</th>
                                <th>District</th>
                                <th>Etc Power Consume (MW)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sumDetails_sl=0;
                        foreach($summary_data as $data){
                            $sumDetails_sl++;
                            ?>
                            <tr class="">
                                <td align="center"><?php echo $sumDetails_sl ?></td>
                                <td align="center"><?php echo $data['district_name']?></td>
                                <td align="right"><?php echo number_format($data['unit'],4)?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>




<!--        <div class="row text-center">-->
<!--            <div class="col-md-4">-->
<!--                    <span class="fa-stack fa-4x">-->
<!--                        <i class="fa fa-circle fa-stack-2x text-primary"></i>-->
<!--                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>-->
<!--                    </span>-->
<!--                <h4 class="service-heading">Today Total Consumption</h4>-->
<!--                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>-->
<!--            </div>-->
<!--            <div class="col-md-4">-->
<!--                    <span class="fa-stack fa-4x">-->
<!--                        <i class="fa fa-circle fa-stack-2x text-primary"></i>-->
<!--                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>-->
<!--                    </span>-->
<!--                <h4 class="service-heading">Top 10 Consumption District List</h4>-->
<!--                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>-->
<!--            </div>-->
<!--            <div class="col-md-4">-->
<!--                    <span class="fa-stack fa-4x">-->
<!--                        <i class="fa fa-circle fa-stack-2x text-primary"></i>-->
<!--                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>-->
<!--                    </span>-->
<!--                <h4 class="service-heading">Web Security</h4>-->
<!--                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>-->
<!--            </div>-->
<!--        </div>-->


    </div>
</section>

<!-- Portfolio Grid Section  class="bg-light-gray"-->
<section id="moreinfo"  style="background-color: #c3defe">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">More Information</h2>
                <h3 class="section-subheading text-muted" style="color: #122b40" >Details Statement Usages of Electricity.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="views/Consume/index.php" class="portfolio-link" data-toggle="modal"> <!-- #portfolioModal1 -->
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="./neci/img/portfolio/Electricity_A.jpg" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>On Date</h4>
                    <p class="text-muted">Usages of Electricity on Current Date</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="views/Consume/daily_st.php" class="portfolio-link" data-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="./neci/img/portfolio/Electricity_C.png" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Date to date</h4>
                    <p class="text-muted">Usages of Electricity on Date to Date</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="views/Consume/yearly_st.php" class="portfolio-link" data-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="./neci/img/portfolio/Electricity_B.jpg" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Yearly</h4>
                    <p class="text-muted">Usages of Electricity on Yearly</p>
                </div>
            </div>


<!--            <div class="col-md-4 col-sm-6 portfolio-item">-->
<!--                <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">-->
<!--                    <div class="portfolio-hover">-->
<!--                        <div class="portfolio-hover-content">-->
<!--                            <i class="fa fa-plus fa-3x"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <img src="./neci/img/portfolio/golden.png" class="img-responsive" alt="">-->
<!--                </a>-->
<!--                <div class="portfolio-caption">-->
<!--                    <h4>Golden</h4>-->
<!--                    <p class="text-muted">Website Design</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-4 col-sm-6 portfolio-item">-->
<!--                <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">-->
<!--                    <div class="portfolio-hover">-->
<!--                        <div class="portfolio-hover-content">-->
<!--                            <i class="fa fa-plus fa-3x"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <img src="./neci/img/portfolio/escape.png" class="img-responsive" alt="">-->
<!--                </a>-->
<!--                <div class="portfolio-caption">-->
<!--                    <h4>Escape</h4>-->
<!--                    <p class="text-muted">Website Design</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-4 col-sm-6 portfolio-item">-->
<!--                <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">-->
<!--                    <div class="portfolio-hover">-->
<!--                        <div class="portfolio-hover-content">-->
<!--                            <i class="fa fa-plus fa-3x"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <img src="./neci/img/portfolio/dreams.png" class="img-responsive" alt="">-->
<!--                </a>-->
<!--                <div class="portfolio-caption">-->
<!--                    <h4>Dreams</h4>-->
<!--                    <p class="text-muted">Website Design</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            -->


        </div>
    </div>
</section>

<!-- About Section -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">About us</h2>
                <h3 class="section-subheading text-muted">National Electricity Consumption Information(NECI)</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                            <!-- <img class="img-circle img-responsive" src="img/about/1.jpg" alt=""> -->
                            <h4>Be Part
                                <br>Of Our
                                <br>Story!</h4>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2016</h4>
                                <h4 class="subheading">Our Moto</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted" style="font-size:16px;">As We know in Bangladesh how many electricity produce (MW) in everyday. But We don't know which District how many electricity are consumed, We think a good informtion  can store if available,to dispaly the informtion for general people and the athurity. And the others things we don't know the the local authority and their contact No. and Build a good communication between all authority to exchange informtion.!</p>
                            </div>
                        </div>
                    </li>

                    <!-- <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>Be Part
                                <br>Of Our
                                <br>Story!</h4>
                        </div>
                    </li> -->
                    <!--  <li class="timeline-inverted">
                         <div class="timeline-image">
                             <img class="img-circle img-responsive" src="img/about/2.jpg" alt="">
                         </div>
                         <div class="timeline-panel">
                             <div class="timeline-heading">
                                 <h4>March 2011</h4>
                                 <h4 class="subheading">An Agency is Born</h4>
                             </div>
                             <div class="timeline-body">
                                 <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                             </div>
                         </div>
                     </li>
                     <li>
                         <div class="timeline-image">
                             <img class="img-circle img-responsive" src="img/about/3.jpg" alt="">
                         </div>
                         <div class="timeline-panel">
                             <div class="timeline-heading">
                                 <h4>December 2012</h4>
                                 <h4 class="subheading">Transition to Full Service</h4>
                             </div>
                             <div class="timeline-body">
                                 <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                             </div>
                         </div>
                     </li>
                     <li class="timeline-inverted">
                         <div class="timeline-image">
                             <img class="img-circle img-responsive" src="img/about/4.jpg" alt="">
                         </div>
                         <div class="timeline-panel">
                             <div class="timeline-heading">
                                 <h4>July 2014</h4>
                                 <h4 class="subheading">Phase Two Expansion</h4>
                             </div>
                             <div class="timeline-body">
                                 <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                             </div>
                         </div>
                     </li> -->

                </ul>
            </div>
        </div>
    </div>
</section>
<!-----
 <!-- Board Member -->
<section id="boardMember" class="">

    <iframe
        src="views/BoardMember/index.php"
        width="100%"
        scrolling="no"
        id="the_iframe"
        onLoad="calcHeight();"
        height="1px"
        frameborder="0"
    >
    </iframe>
</section>
<!-- Team Section -->
<section id="team" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Our Amazing Team</h2>
                <h3 class="section-subheading text-muted">The Titans.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="team-member">
                    <img src="./neci/img/team/1.jpg" class="img-responsive img-circle" alt="">
                    <h4>Partha Protim Paul</h4>
                    <p class="text-muted">Lead Designer</p>
                    <ul class="list-inline social-buttons">
<!--                        <li><a href="#"><i class="fa fa-twitter"></i></a>-->
<!--                        </li>-->
<!--                        <li><a href="#"><i class="fa fa-facebook"></i></a>-->
<!--                        </li>-->
<!--                        <li><a href="#"><i class="fa fa-linkedin"></i></a>-->
<!--                        </li>-->
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="team-member">
                    <img src="./neci/img/team/2.jpg" class="img-responsive img-circle" alt="">
                    <h4>Md. Sajib Hosen</h4>
                    <p class="text-muted">Designer</p>
                    <ul class="list-inline social-buttons">
<!--                        <li><a href="#"><i class="fa fa-twitter"></i></a>-->
<!--                        </li>-->
<!--                        <li><a href="#"><i class="fa fa-facebook"></i></a>-->
<!--                        </li>-->
<!--                        <li><a href="#"><i class="fa fa-linkedin"></i></a>-->
<!--                        </li>-->
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="team-member">
                    <img src="./neci/img/team/3.jpg" class="img-responsive img-circle" alt="">
                    <h4>Avijit Rohan</h4>
                    <p class="text-muted">Designer</p>
                    <ul class="list-inline social-buttons">
<!--                        <li><a href="#"><i class="fa fa-twitter"></i></a>-->
<!--                        </li>-->
<!--                        <li><a href="#"><i class="fa fa-facebook"></i></a>-->
<!--                        </li>-->
<!--                        <li><a href="#"><i class="fa fa-linkedin"></i></a>-->
<!--                        </li>-->
                    </ul>
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="team-member">
                <img src="./neci/img/team/4.jpg" class="img-responsive img-circle" alt="">
                <h4>Md. Ismail Hossain</h4>
                <p class="text-muted">Designer</p>
                <ul class="list-inline social-buttons">
<!--                    <li><a href="#"><i class="fa fa-twitter"></i></a>-->
<!--                    </li>-->
<!--                    <li><a href="#"><i class="fa fa-facebook"></i></a>-->
<!--                    </li>-->
<!--                    <li><a href="#"><i class="fa fa-linkedin"></i></a>-->
<!--                    </li>-->
                </ul>
            </div>
        </div>
    </div>

<!--        <div class="row">-->
<!--            <div class="col-lg-8 col-lg-offset-2 text-center">-->
<!--                <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</section>





<!-- Contact Section -->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Contact Us</h2>
                <h3 class="section-subheading text-muted"></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form role="form" action="views/Visitor_Message/Vmessage.php"   method="post"><!--id="contactForm"-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name *" name="visitor_name" id="visitor_name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email *" name="visitor_email" id="visitor_email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" placeholder="Your Phone *" name="visitor_phone" id="visitor_phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="form-email">Your City</label>
                                <select  type="text" name="district_cd" class="form-control" id="form-email" required>
                                    <option selected>Select Your City</option>
                                    <?php
                                    $i=0;
                                    foreach ($alcity as $city){
                                        echo "<option value=\"".$city['district_cd']."\">".$city['district_name']."</option>";
                                    }
                                    ?>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>



                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Your Message *" name="visitor_message" id="" required data-validation-required-message="Please enter a message."></textarea>
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>
<!--                        <button type="submit" class="btn">Sign me up!</button>-->
                                                    <div class="clearfix"></div>
                                                    <div class="col-lg-12 text-center">
                                                        <div id="success"></div>
                                                        <button type="submit" class="btn btn-xl">Send Message</button>
                                                    </div>
                       </div>
                </form>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; NECI 2016</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                    <li><a href="#">Privacy Policy</a>
                    </li>
                    <li><a href="#">Terms of Use</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Portfolio Modals -->
<!-- Use the modals below to showcase details about your portfolio projects! -->

<!-- Portfolio Modal 1 -->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <!-- Project Details Go Here -->
                        <h2>Project Name</h2>
                        <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                        <img class="img-responsive img-centered" src="img/portfolio/roundicons-free.png" alt="">
                        <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                        <p>
                            <strong>Want these icons in this portfolio item sample?</strong>You can download 60 of them for free, courtesy of <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">RoundIcons.com</a>, or you can purchase the 1500 icon set <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">here</a>.</p>
                        <ul class="list-inline">
                            <li>Date: July 2014</li>
                            <li>Client: Round Icons</li>
                            <li>Category: Graphic Design</li>
                        </ul>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Modal 2 -->
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Project Heading</h2>
                        <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                        <img class="img-responsive img-centered" src="img/portfolio/startup-framework-preview.png" alt="">
                        <p><a href="http://designmodo.com/startup/?u=787">Startup Framework</a> is a website builder for professionals. Startup Framework contains components and complex blocks (PSD+HTML Bootstrap themes and templates) which can easily be integrated into almost any design. All of these components are made in the same style, and can easily be integrated into projects, allowing you to create hundreds of solutions for your future projects.</p>
                        <p>You can preview Startup Framework <a href="http://designmodo.com/startup/?u=787">here</a>.</p>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Modal 3 -->
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <!-- Project Details Go Here -->
                        <h2>Project Name</h2>
                        <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                        <img class="img-responsive img-centered" src="img/portfolio/treehouse-preview.png" alt="">
                        <p>Treehouse is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. This is bright and spacious design perfect for people or startup companies looking to showcase their apps or other projects.</p>
                        <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/treehouse-free-psd-web-template/">FreebiesXpress.com</a>.</p>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Modal 4 -->
<div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <!-- Project Details Go Here -->
                        <h2>Project Name</h2>
                        <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                        <img class="img-responsive img-centered" src="img/portfolio/golden-preview.png" alt="">
                        <p>Start Bootstrap's Agency theme is based on Golden, a free PSD website template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Golden is a modern and clean one page web template that was made exclusively for Best PSD Freebies. This template has a great portfolio, timeline, and meet your team sections that can be easily modified to fit your needs.</p>
                        <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/golden-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Modal 5 -->
<div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <!-- Project Details Go Here -->
                        <h2>Project Name</h2>
                        <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                        <img class="img-responsive img-centered" src="img/portfolio/escape-preview.png" alt="">
                        <p>Escape is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Escape is a one page web template that was designed with agencies in mind. This template is ideal for those looking for a simple one page solution to describe your business and offer your services.</p>
                        <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/escape-one-page-psd-web-template/">FreebiesXpress.com</a>.</p>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Modal 6 -->
<div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <!-- Project Details Go Here -->
                        <h2>Project Name</h2>
                        <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                        <img class="img-responsive img-centered" src="img/portfolio/dreams-preview.png" alt="">
                        <p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                        <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- jQuery -->
    <script src="./neci/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./neci/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="./neci/js/jqBootstrapValidation.js"></script>
    <script src="./neci/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="./neci/js/agency.min.js"></script>


    <script type="text/javascript">
        function calcHeight()
        {
            //find the height of the internal page
            var the_height=
                document.getElementById('the_iframe').contentWindow.
                    document.body.scrollHeight;

            //change the height of the iframe
            document.getElementById('the_iframe').height=
                the_height;
        }
    </script>
    <script>
        $('#message').show().delay(3000).fadeOut();
    </script>
</body>
</html>

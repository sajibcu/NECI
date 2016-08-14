<?php
include_once ('../../vendor/autoload.php');
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;
//use App\Bitm\Visitor_Message\Vmessage;
//$cMessage=new Vmessage();
//$vMessage=$cMessage->count_message();
//Utility::dd($vMessage);
?>
<div class="mainbar">

  <div class="container">

    <button type="button" class="btn mainbar-toggle" data-toggle="collapse" data-target=".mainbar-collapse">
      <i class="fa fa-bars"></i>
    </button>

    <div class="mainbar-collapse collapse">

      <ul class="nav navbar-nav mainbar-nav">
        <li class="active">
          <a href="dashboard.php">
            <i class="fa fa-dashboard"></i>Dashboard

          </a>
        </li>

<?php
include 'session.php';
if (!isset($_SESSION['user_id'])) {
  header("Location:Signup.php");
}


if($_SESSION['role']==1) {
  ?>
	    <li class='dropdown tran my-mainbar-nav'>
          <a href='#about' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown'>
            <i class='fa fa-user-plus'></i>Manage<span class='caret'></span>
          </a>
          <ul class='dropdown-menu'>
            <li><a href='user_approval.php'><i class='fa fa-bars nav-icon'></i>&nbsp;User Approval</a></li>
            <li><a href='CreateNewAdmin.php'><i class='fa fa-tasks nav-icon'></i>&nbsp;Admin Create</a></li>
            <li><a href='admin_list.php'><i class='fa fa-key nav-icon'></i>&nbsp;Admin List</a></li>


              <li><a href='add_notice.php'><i class='fa fa-tasks nav-icon'></i>&nbsp;Add Notice</a></li>
              <li><a href='notice_index.php'><i class='fa fa-key nav-icon'></i>&nbsp;Notice List</a></li>

              
          </ul>
        </li>
		<li class='dropdown tran my-mainbar-nav'>
          <a href='#about' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown'>
            <i class='fa fa-maxcdn'></i>MIS Report<span class='caret'></span>
          </a>
          <ul class='dropdown-menu'>
            <li><a href='last_five_days_summary.php'><i class='fa fa-bars nav-icon'></i>&nbsp;Consumption Summary</a></li>
            <li><a href='admin_daily_st.php'><i class='fa fa-bars nav-icon'></i>&nbsp;Date to date</a></li>
            <li><a href='admin_yearly_st.php'><i class='fa fa-bars nav-icon'></i>&nbsp;Yearly</a></li>
<!--            <li><a href='#'><i class='fa fa-bars nav-icon'></i>&nbsp;Consumption Details</a></li>-->
            <li><a href='#'><i class='fa fa-bars nav-icon'></i>&nbsp;Made my graph</a></li>
          </ul>
        </li>
        <li class='dropdown tran my-mainbar-nav'>
            <a href='#about' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown'>
                <i class='fa fa-eye'></i>Investigation<span class='caret'></span>
            </a>
           <ul class='dropdown-menu'>
               <li><a href='daily_investigation.php'><i class='fa fa-bars nav-icon'></i>&nbsp;Daily</a></li>
           </ul>
        </li>
	<?php
}
elseif($_SESSION['role']==2) {
  ?>

	    <li class='dropdown tran my-mainbar-nav'>
          <a href='#about' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown'>
            <i class='fa fa-user'></i>Manage<span class='caret'></span>
          </a>
          <ul class='dropdown-menu'>
            <li><a href='add_consumption.php'><i class='fa fa-bars nav-icon'></i>&nbsp;Add Consumption</a></li>
            <li><a href='add_notice.php'><i class='fa fa-tasks nav-icon'></i>&nbsp;Add Notice</a></li>
			<li><a href='notice_index.php'><i class='fa fa-key nav-icon'></i>&nbsp;Notice List</a></li>
          </ul>
        </li>
        <li class='dropdown tran my-mainbar-nav'>
          <a href='#about' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown'>
            <i class='fa fa-maxcdn'></i>MIS Report<span class='caret'></span>
          </a>
          <ul class='dropdown-menu'>
            <li><a href='last_five_days_summary.php'><i class='fa fa-bars nav-icon'></i>&nbsp;Consumption Summary</a></li>
            <li><a href='user_daily_st.php'><i class='fa fa-bars nav-icon'></i>&nbsp;Daily Statement</a></li>
            <li><a href='admin_yearly_st.php'><i class='fa fa-bars nav-icon'></i>&nbsp;Yearly</a></li>
          </ul>
        </li>
        
        <!--------Message--->
        <li class='dropdown tran my-mainbar-nav'> 
      
          <a href='#about' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown'>
            <i class='fa fa-envelope'></i>Message <?php if(!empty($vMessage)) {echo '('.$vMessage.')';} else{"";} ?><span class='caret'></span>

          </a> 
          <ul class='dropdown-menu'>   
            <li><a href='../User/message_index.php'><i class='fa fa-bars nav-icon'></i>View Message</a></li>
          </ul>
        </li>
        <?php
}
?>
        

      </ul>

    </div> <!-- /.navbar-collapse -->   

  </div> <!-- /.container --> 

</div>
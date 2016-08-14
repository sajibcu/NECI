<?php
session_start();
include_once('../../vendor/autoload.php.');
use App\Bitm\Notice\Notice;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;

$maxsl = new Notice();
//$tmaxsl=$maxsl->sl_count();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../Resources/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../Resources/bootstrap/js/bootstrap.js">
    <link rel="stylesheet" type="text/css" href="../../Resources/bootstrap/xcss/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
</head>
<body>


<div class="portlet">
    <div class="portlet-header">
<div class="container">
    <a href="index.php" class="btn btn-info" role="button">Book Title Home Page</a>
    <h2>Add Notice</h2>
    <div class="ebox" style="width: 750px" align="left" >
        <form role="form" action="store.php" method="post">

            <div class="form-group has-default">
                <label for="name">District Code</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class='fa fa-tint'></i></div>
                    <input type="text" id="packagename" name="district_cd" placeholder="District Code" class="form-control" required="true">
                </div>
            </div>

            <div class="form-group has-default">
                <label for="name">User ID</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class='fa fa-tint'></i></div>
                    <input type="text" id="packagename" name="user_id" placeholder="User ID" class="form-control" required="true">
                </div>
            </div>


            <div class="form-group has-default">
                <label for="name">Notice Title</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class='fa fa-tint'></i></div>
                    <input type="text" id="packagename" name="notice_title" placeholder="Notice Title" class="form-control" required="true">
                </div>
            </div>



            <div class="form-group has-default">
                <label for="name">Notice Content</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class='fa fa-indent'></i></div>
                    <textarea name="notice_content" class="form-control" cols="30" rows="10"></textarea>
                </div>
            </div>



<!--            <div class="row" style="width: 600px">-->
<!--                <div class="form-group row bo-ac">-->
<!--                    <label  class="col-md-4 col-sm-12">District code:</label>-->
<!--                    <div class="col-md-8 col-sm-12" style="width:200px">-->
<!--                        <input type="text" name="district_cd" class="form-control" id="email" value="--><?php //echo $tmaxsl+1?><!-- " placeholder="Enter disctric Code" readonly="readonly">-->
<!--                    </div>-->
<!--                </div>-->






                <!--<div class="form-group">
                    <label>Enter time</label>
                    <input type="text" name="input_time" class="form-control" id="email" placeholder="Enter time">
                </div>-->


                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<script>
    tinymce.init({
        selector: '#notice_title'
    });
</script>
</body>
</html>

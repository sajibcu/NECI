<?php
session_start();
include_once('../../vendor/autoload.php.');
use App\Bitm\District\District;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;

$maxsl = new District();
$tmaxsl=$maxsl->sl_count();

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

<div class="container">
    <a href="index.php" class="btn btn-info" role="button">Book Title Home Page</a>
    <h2>Add District Information</h2>
    <div class="ebox" style="width: 450px" align="left" >
        <form role="form" action="store.php" method="post">
            <div class="row" style="width: 600px">
                <div class="form-group row bo-ac">
                    <label  class="col-md-4 col-sm-12">District code:</label>
                    <div class="col-md-8 col-sm-12" style="width:200px">
                        <input type="text" name="district_cd" class="form-control" id="email" value="<?php echo $tmaxsl+1?> " placeholder="Enter disctric Code" readonly="readonly">
                    </div>
                </div>


                <div class="form-group row bo-ac">
                    <label class="col-md-4 col-sm-12">Enter District Name:</label>
                    <div class="col-md-8 col-sm-12" style="width:200px">
                        <input type="text" name="district_name" class="form-control" id="email" placeholder="Enter District Name">
                    </div>
                </div>



                <!--<div class="form-group">
                    <label>Enter time</label>
                    <input type="text" name="input_time" class="form-control" id="email" placeholder="Enter time">
                </div>-->


                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </form>
    </div>
</div>
<script>
    tinymce.init({
        selector: '#unit'
    });
</script>
</body>
</html>

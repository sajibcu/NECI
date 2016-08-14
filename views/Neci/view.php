<?php
include_once('../../vendor/autoload.php');
use App\Bitm\Neci\Neci;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;


$book= new Neci();
$singleData=$book->prepare($_GET)->view();
//Utility::d($singleData);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <a href="index.php" class="btn btn-info" role="button">Book Title Home Page</a>
  <h2>View Booktitle </h2>
  <ul class="list-group">
    <li class="list-group-item">ID: <?php echo $singleData['id']?> </li>
    <li class="list-group-item">Book Title:<?php echo $singleData['district_cd'] ?> </li>
    <li class="list-group-item">Book Desc: <?php echo $singleData['user_id'] ?> </li>
    <li class="list-group-item">Book Desc: <?php echo $singleData['input_date'] ?> </li>
    <li class="list-group-item">Book Desc: <?php echo $singleData['unit'] ?> </li>
  </ul>
</div>

</body>
</html>




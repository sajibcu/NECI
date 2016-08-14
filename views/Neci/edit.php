<?php
include_once('../../vendor/autoload.php');
use App\Bitm\Neci\Neci;
use App\Bitm\Message\Message;
use App\Bitm\Utility\Utility;

$book= new Neci();
$singleItem= $book->prepare($_GET)->view();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../Resources/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../Resources/bootstrap/js/bootstrap.js">
</head>
<body>

<div class="container">
    <a href="index.php" class="btn btn-info" role="button">Book Title Home Page</a>
    <h2>Book Title Update</h2>
    <form role="form" action="update.php" method="post">
        <div class="form-group">
            <label>Update Consume Data:</label>
            <input type="hidden" name="id"   value="<?php echo $singleItem['id']?>">
            <label>Update Consume Data:</label>
            <input type="text" name="input_date"   value="<?php echo $singleItem['input_date']?>">
            <label>Update Consume Data:</label>
            <input type="text" name="unit" class="form-control" id="email" value="<?php echo $singleItem['unit']?>">
          

        </div>

        <button type="submit" class="btn btn-default">Update</button>
    </form>
</div>

</body>
</html>

<?php

include_once('../../vendor/autoload.php.');
use App\Bitm\Neci\Neci;
use App\Bitm\Utility\Utility;
use App\Bitm\Message\Message;



$data= new Neci();
$trashedData=$data->trashed();

//Utility::dd($trashedBook);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../Resources/bootstrap/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <!--  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
</head>
<body>

<div class="container">
    <h2>Trashed List Book Title</h2>

    <a href="index.php" class="btn btn-info" role="button">Main Page Book Title</a>
    
    <br>
    <br>

    <form action="recoverMultiple.php" method="post" id="multiple">
        <button type="submit" class="btn btn-info">Recover Selected</button>
        <button type="button" class="btn btn-primary" id="delete">Delete all Selected</button>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Select</th>
                <th>SL#</th>
                <th>ID</th>
                <th>Book Title</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sl=0;
            foreach($trashedData as $trash){
                $sl++;
                ?>
                <tr>
                    <td><input type="checkbox" name=mark[] value="<?php echo $trash['id'] ?>"></td>
                    <td><?php echo $sl; ?></td>
                    <td><?php echo $trash['id'] // for object: $book->id ; ?></td>
                    <td><?php echo $trash['district_cd'] // for object: $book->title; ?></td>
                    <td><?php echo $trash['user_id'] // for object: $book->title; ?></td>
                    <td><?php echo $trash['input_date'] // for object: $book->title; ?></td>
                    <td><?php echo $trash['unit'] // for object: $book->title; ?></td>
                    <td>
                        <a href="recover.php?id=<?php echo $trash['id']?>" class="btn btn-info  btn-xs" role="button">Recover</a>
                        <a href="delete.php?id=<?php echo $trash['id']?>" class="btn btn-danger  btn-xs" role="button">Delete</a>

                    </td>


                </tr>
            <?php } ?>


            </tbody>
        </table>
    </form>
    </div>
</div>
<script>
    $('#delete').on('click',function(){
        document.forms[0].action="deleteMultiple.php";
        $('#multiple').submit();
    });
</script>


</body>
</html>

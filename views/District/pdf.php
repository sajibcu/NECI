<?php
include_once ('../../../vendor/mpdf/mpdf/mpdf.php');
include_once ('../../../vendor/autoload.php');
use App\Bitm\SEIP124367\Book\Book;

$book= new Book();
$allData= $book->index();
//var_dump($allData);
//die();

$trs="";
$sl=0;
foreach($allData as $data):
    $sl++;
    $trs.="<tr>";
    $trs.="<td>$sl</td>";
    $trs.="<td>".$data['id']."</td>";
    $trs.="<td>".$data['title']."</td>";
    $trs.="<td>".$data['description']."</td>";
    $trs.="</tr>";
endforeach;


$html=<<<EOD
<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="container">
  <h2>All Book Title List</h2>
   <table class="table">
    <thead>
      <tr>
        <th>SL#</th>
        <th>ID</th>
        <th>Book Title</th>
        <th>Description</th>

      </tr>
    </thead>
    <tbody>
        $trs
    </tbody>

</table>
</body>
</html>
EOD;

$mpdf = new mPDF();

// Write some HTML code:

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output("All Book Title list.pdf",'D');
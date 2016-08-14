<?php
require('../config.php');

$date = $_GET['parent_cat'];

// Fetch the data
$query = "SELECT DATE_FORMAT(input_date, '%b') as input_date,SUM(unit) unit FROM consume_details WHERE YEAR(input_date)='$date' group by MONTHNAME(input_date) order by MONTH(input_date) asc";

$result = mysql_query( $query );

// Print out rows
$prefix = '';
echo "[\n";
while ( $row = mysql_fetch_assoc( $result ) ) {
    echo $prefix . " {\n";
    $colors = array('#FF0F00', '#FF6600', '#FF9E01', '#FCD202', '#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74','#754DEB','#DDDDDD','#999999','#333333','#000000');
    echo '  "Marks": ' . json_encode($row['unit']) . ',' . "\n";
    echo '  "Color": ' . json_encode($colors[array_rand($colors)]) . ',' . "\n";
    echo '  "Topic": ' . json_encode($row['input_date']).'' ;
    echo " }";
    $prefix = ",\n";
}
echo "\n]";

?>
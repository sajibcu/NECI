<?php
//session_start();
//include_once('../../../vendor/autoload.php');
//use App\Bitm\Chart\Chart;
//use App\Bitm\Utility\Utility;
//use App\Bitm\Message\Message;
//
//$gyear= new Chart();
//$gyear2=$gyear->getYear2();
//Utility::dd($gyear2);
//die();
//
//?>


<?php require('config.php') ?>


<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>3D Market Movement Chart</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="amcharts/jquery.min.js"></script>

</head>

<body bgcolor=""><!--#F2F7D5-->

<script src="amcharts/amcharts.js"></script>
<script src="amcharts/serial.js"></script>
<script src="amcharts/light.js"></script>

<!-- Combobox Starts -->

<br /><br />
<select id="basic" style="width:100px;height:25px;border-radius:5px;border:1px solid #F47724;color:#F47724;">
    <option value="" style="display:none;">Select</option>
    <!-- <option value="Not Entered">Please Select Student</option> -->

    <?php
    $query=mysql_query("SELECT YEAR (input_date) as YEAR FROM `consume_details` group by YEAR ORDER BY YEAR(input_date) DESC");
    while($year_date=mysql_fetch_array($query)) {
        $year=$year_date['0'];
        echo "<option value='$year'>$year</option>";
    }
    ?>

    <!--	--><?php
    //	$i=0;
    //	foreach ($gyear2 as $all_year){
    //		$yrr=$all_year['cyear'];
    //		echo "<option value='$yrr'>$yrr</option>";
    //
    //	}
    //	?>
</select>
<div style="float:left;font-size:16px;color:#F47724;">Select your expected year&nbsp;&nbsp;</div>
<div style="float:right;font-size:25px;color:#00B3E0;margin-right:5px;"></div>
<!-- Combobox Ends -->

<div id="chartdiv" style="width: 100%; height: 310px;"></div>

<div class="container-fluid">
    <div class="row text-center" style="overflow:hidden;">
        <div class="col-sm-3" style="float: none !important;display: inline-block;">
            <label class="text-left">Top Radius:</label>
            <input class="chart-input" data-property="topRadius" type="range" min="0" max="1.5" value="1" step="0.01"/>
        </div>

        <div class="col-sm-3" style="float: none !important;display: inline-block;">
            <label class="text-left">Angle:</label>
            <input class="chart-input" data-property="angle" type="range" min="0" max="89" value="30" step="1"/>
        </div>

        <div class="col-sm-3" style="float: none !important;display: inline-block;">
            <label class="text-left">Depth:</label>
            <input class="chart-input" data-property="depth3D" type="range" min="1" max="120" value="40" step="1"/>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $("#basic").change(function(e) {

            $.getJSON('JSON/GetChart.php?parent_cat=' + $(this).val(), function(dataChart) {


                var chart = AmCharts.makeChart("chartdiv", {
                    "theme": "light",
                    "type": "serial",
                    "startDuration": 2,
                    "dataProvider": dataChart,
                    "valueAxes": [{
                        "position": "left",
                        "axisAlpha":0,
                        "gridAlpha":0
                    }],
                    "graphs": [{
                        "balloonText": "[[category]]: <b>[[value]]</b>",
                        "colorField": "Color",
                        "fillAlphas": 0.85,
                        "lineAlpha": 0.1,
                        "type": "column",
                        "topRadius":1,
                        "valueField": "Marks"
                    }],
                    "depth3D": 40,
                    "angle": 30,
                    "chartCursor": {
                        "categoryBalloonEnabled": false,
                        "cursorAlpha": 0,
                        "zoomable": false
                    },
                    "categoryField": "Topic",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "axisAlpha":0,
                        "gridAlpha":0

                    },
                    "export": {
                        "enabled": true
                    }

                },0);

                jQuery('.chart-input').off().on('input change',function() {
                    var property    = jQuery(this).data('property');
                    var target      = chart;
                    chart.startDuration = 0;

                    if ( property == 'topRadius') {
                        target = chart.graphs[0];
                    }

                    target[property] = this.value;
                    chart.validateNow();
                });
            });
        });
    });
</script>

<script src='amcharts/jquery-1.11.2.min.js'></script>

</body>
</html>
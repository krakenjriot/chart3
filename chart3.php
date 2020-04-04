<?php

  $title = "NEW Ambient Temperature Graph (c)";
  $legend_sensor_name = "Temprature";
  $legend_time_name =  "Time";
  $number_of_samples =  "1000";
  $interval_span =  "30"; //mins

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
</script> 

<script type="text/javascript">
google.charts.load('current', {
  callback: function () {
	  
    drawChart();
    //setInterval(drawChart, (15 * 60 * 1000));
    setInterval(drawChart, (3000));

    function drawChart() {
      $.ajax({        
        url: 'fetch_3.php',
        type: 'get',
		datatype: 'json',
        success: function (txt) {
          // check for trailing comma
          if (txt.slice(-1) === ',') {
            txt = txt.substring(0, txt.length - 1);
          }
		  
          var txtData = JSON.parse('[["Minutes", "Temp", "Humidity"],' + txt + ']');
          var data = google.visualization.arrayToDataTable(txtData);

          var options = {
            title: 'Environmental Readings for last 15 Minutes',
            curveType: 'function',
            hAxis: {
              title: 'Last 15 Minutes',
              direction: '-1'
            },
            legend: { position: 'bottom' }
          };

          var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
          chart.draw(data, options);
        }
      });
    }
  },
  packages: ['corechart']
  
});
</script>   

<div id="curve_chart" style="width: 900px; height: 500px">
</div>

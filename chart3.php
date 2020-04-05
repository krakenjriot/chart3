<?php

  //$title = "NEW Ambient Temperature Graph (c)";
  //$legend_sensor_name = "Temprature";
  //$legend_time_name =  "Time";
  //$number_of_samples =  "1000";
  //$interval_span =  "30"; //mins
  $t_span = date("i",time()); //minute
  //$m = 15; //minute

  date_default_timezone_set("Asia/Riyadh");

	///echo $t_span;
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script language="JavaScript" type="text/javascript">
	//setTimeout("location.href = 'chart3.php?t_span=<?php echo $t_span; ?>'",15000); // milliseconds, so 10 seconds = 10000ms
	setTimeout("location.href = 'chart3.php?t_span=<?php echo $t_span; ?>'", 1 * 60 * 1000 ); // milliseconds, so 10 seconds = 10000ms
</script>

</script>
<div id="curve_chart" style="width: 900px; height: 500px">
<script type="text/javascript">
google.charts.load('current', {
  callback: function () {

    drawChart();
    setInterval(drawChart, (1 * 60 * 1000));
    //setInterval(drawChart, (5000));

    function drawChart() {
      $.ajax({
        url: 'fetch_3.php?t_span=<?php echo $t_span; ?>',
        type: 'get',
		datatype: 'json',
        success: function (txt) {
          // check for trailing comma
          if (txt.slice(-1) === ',') {
            txt = txt.substring(0, txt.length - 1);
          }

          var txtData = JSON.parse('[["number", "Temp ºC", "Humidity %"],' + txt + ']');
          var data = google.visualization.arrayToDataTable(txtData);

          var options = {

			title: 'Date/Time: <?php echo date('h A ( M-d-Y )',time()); ?>',
            curveType: 'function',

			hAxis: {
              title: 'Last 15 Minutes',
              //direction: '-1'
            },

			vAxis: {
              title: 'Values',
              //direction: '-1'
            },

			legend: { position: 'bottom' }
          };

          //var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
          var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
          chart.draw(data, options);

		//var chart = new google.charts.Line(document.getElementById('curve_chart'));
		//chart.draw(data, google.charts.Line.convertOptions(options));

        }
      });
    }
  },
  packages: ['corechart']

});
</script>


</div>

<?php
  $title = "Temperature (ºC) / Humidity Graph (%)"; //degree symbol Alt+0186
  $legend_sensor_name1 = "Temperature (ºC)";
  $legend_sensor_name2 = "Humidity (%)";
  $legend_time_name =  "Time";
  $number_of_samples =  "1000";
  $interval_span =  "30"; //mins
?>


<?php
//echo '[15, 106],[14, 105],[13, 110],[12, 119],[11, 107],[10, 132],[9, 121],[8, 111],[7, 126],[6, 115],[5, 109],';
?>

<?php

    //breakdown current date/time
					//$y = date("Y");
					//$mo = date("m");
					//$d = date("d");
					//$h = date("H");
					//$m = date("i");
					//$s = date("s");
				//echo date("Y-m-d H:i:s",strtotime("-30 minutes"))."</br>";
				//echo date("Y-m-d H:i:s",strtotime("now"));

	  date_default_timezone_set("Asia/Riyadh");


      $db_server = "localhost";
      $db_user = "root";
      $db_pass = "";
      $db_name = "mydb";

      // Create DB connection
      $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
      // Check connection
      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }


      //$sql = " SELECT *  FROM tbl_sensors ORDER BY id DESC LIMIT $number_of_samples ";
      //$sql = " SELECT *  FROM tbl_sensors WHERE dtime BETWEEN '".date("Y-m-d H:i:s",strtotime("-30 minutes"))."' AND '".date("Y-m-d H:i:s",strtotime("now"))."' ORDER BY id DESC LIMIT $number_of_samples ";
      //$sql = " SELECT *  FROM tbl_sensors WHERE dtime BETWEEN '".date("Y-m-d H:i:s",strtotime("-$interval_span minutes"))."' AND '".date("Y-m-d H:i:s",strtotime("now"))."' ORDER BY id DESC "; // LIMIT $number_of_samples ";
      $sql = " SELECT *  FROM tbl_sensors WHERE dtime BETWEEN '".date("Y-m-d H:i:s",strtotime("-$interval_span minutes"))."' AND '".date("Y-m-d H:i:s",strtotime("now"))."' ORDER BY id DESC LIMIT $number_of_samples ";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
		$i = 0;
        while($row = $result->fetch_assoc()) {
					$i++;
					$time = strtotime($row['dtime']);
					//$time = (int) date("i",$row['dtime']);
					//$y = date("Y",$time); // year
					//$mo = date("m",$time); //month
					//$d = date("d",$time); //day
					////
					//$h = date("H",$time); // hour
					//$m = floor((intval(date("i",$time))); //minute
					$m = (int)(date("i",$time)); //minute
					//$s = date("s",$time); //second
					//$u = date("u",$time); //milliseconds

					$temp = $row['temp'];
					$hum = $row['hum'];
					//$id = $row['id'];

					if($temp == 0) continue;
					if($hum == 0) continue;
					//echo '[15, 106],[14, 105],[13, 110],[12, 119],[11, 107],[10, 132],[9, 121],[8, 111],[7, 126],[6, 115],[5, 109],';
					//echo "[$i, $hum, $temp],";
					echo "[$m, $hum, $temp],";
					//echo "[new Date($y,$mo,$d,$h,$m,$s), $temp, $hum],";
        }//while
      }//if

//$time = $row['dtime'];







?>

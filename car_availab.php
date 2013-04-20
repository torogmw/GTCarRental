<?php
  session_start();
  include 'dbinfo.php';
?>

<style>
  h1 {
  text-align: center;
  }
  table.db-table { border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align: center; }
  table.db-table th { background:#eee; padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; width: 100px;}
  table.db-table td { padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
</style>

<html>
  <body>

<?php


  
  mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());

  mysql_select_db($database) or die ("Unable to select database");

  $PickupDate=$_POST['PickupDate'];
  $PickupTime=$_POST['PickupTime'];
  $ReturnDate=$_POST['ReturnDate'];
  $ReturnTime=$_POST['ReturnTime'];

  $SRLocationName=$_POST['location'];
echo " Location = ".$SRLocationName."<br>";


$query="SELECT TIMESTAMP('$PickupDate','$PickupTime') AS SRPickupTime;";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$SRPickupTime=$row['SRPickupTime'];


$query="SELECT TIMESTAMP('$ReturnDate','$ReturnTime') AS SRReturnTime;";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$SRReturnTime=$row['SRReturnTime'];


$query="SELECT FORMAT(TIMESTAMPDIFF(SECOND,'$SRPickupTime', '$SRReturnTime')/3600,2) AS SRResvTime;";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$SRResvTime=$row['SRResvTime'];


$UserPlanDiscount=0.85;
// need UserPlanDiscount=0.85;
  
if ($_POST['chooseby'] == 'bytype')
{
	$SRType=$_POST['choose'];
echo "  SRPickupTime = ".$SRPickupTime."<br>";
echo " SRReturnTime = ".$SRReturnTime."<br>";
echo " Location = ".$SRLocationName."<br>";
echo " ResvTime = ".$SRResvTime."<br>";
echo "SRType=".$SRType."<br>";

//	$query="SELECT SerialNumber, Model, LocationName FROM Car WHERE Type='$SRType';";
//	$result = mysql_query($query);




	$query = "
(
	SELECT SerialNumber, Model, Type, LocationName AS 'Location', Color, HourlyRate, HourlyRate*0.9 AS 'DiscountedRate (Frequent)', HourlyRate*0.85 AS 'DiscountedRate (Daily)', DailyRate, Seats, Transmission, Bluetooth, Aux, AvailableTill, FORMAT(HourlyRate*$UserPlanDiscount*'$SRResvTime', 2) AS 'EstimatedCost'
	FROM
	(
		(Car c1)
		INNER JOIN
		(
		SELECT SNumber, MIN(PickupTime) AS AvailableTill
		FROM 
			(
				SELECT DISTINCT SerialNumber AS SNumber, LocationName AS LName
				FROM Car
				WHERE SerialNumber NOT IN 
				(
					SELECT DISTINCT SerialNumber
					FROM Reservation
					WHERE (SerialNumber, PickupTime, ReturnTime) NOT IN (
					SELECT SerialNumber, PickupTime, ReturnTime
					FROM Reservation
					WHERE ReturnTime<'$SRPickupTime' OR PickupTime >'$SRReturnTime'))
					AND LocationName<>'$SRLocationName' AND Type='$SRType'
					AND Flag=1
				) as available_car1
				LEFT OUTER JOIN 
				(
					SELECT * FROM
					Reservation 
					WHERE PickupTime > '$SRReturnTime' AND FORMAT(TIMESTAMPDIFF(SECOND, '$SRReturnTime', PickupTime)/3600, 2) <= 12
				)as resv1
				ON available_car1.SNumber = resv1.SerialNumber AND available_car1.LName = resv1.LocationName )
				GROUP BY (SNumber) 
			)as t1
		)as  ac1 
		ON c1.SerialNumber = ac1.SNumber 
	)as temp1
)as uni1

UNION 

(
	SELECT SerialNumber, Model, Type, LocationName AS 'Location', Color, HourlyRate, HourlyRate*0.9 AS 'DiscountedRate (Frequent)', HourlyRate*0.85 AS 'DiscountedRate (Daily)', DailyRate, Seats, Transmission, Bluetooth, Aux, AvailableTill, FORMAT(HourlyRate*$UserPlanDiscount*'$SRResvTime', 2) AS 'EstimatedCost'
	FROM
	(
		(Car c2)
		INNER JOIN
		(
		SELECT SNumber, MIN(PickupTime) AS AvailableTill
		FROM 
			(
				SELECT DISTINCT SerialNumber AS SNumber, LocationName AS LName
				FROM Car
				WHERE SerialNumber NOT IN 
				(
					SELECT DISTINCT SerialNumber
					FROM Reservation
					WHERE (SerialNumber, PickupTime, ReturnTime) NOT IN (
					SELECT SerialNumber, PickupTime, ReturnTime
					FROM Reservation
					WHERE ReturnTime<'$SRPickupTime' OR PickupTime >'$SRReturnTime'))
					AND LocationName<>'$SRLocationName' AND Type='$SRType'
					AND Flag=1
				) as available_car2
				LEFT OUTER JOIN 
				(
					SELECT * FROM
					Reservation 
					WHERE PickupTime > '$SRReturnTime' AND FORMAT(TIMESTAMPDIFF(SECOND, '$SRReturnTime', PickupTime)/3600, 2) <= 12
				) as resv2
				ON available_car2.SNumber = resv2.SerialNumber AND available_car2.LName = resv2.LocationName )
				GROUP BY (SNumber) 
			)as t2
		)as ac2 
		ON c2.SerialNumber = ac2.SNumber 
	)as temp2
)as uni2;";

	$result = mysql_query($query) or die(mysql_error());


	  echo '<h1>Car Availability</h1>';

	  echo '<table align="center" cellpadding="0" cellspacing="0" class="db-table">';
	  echo '<tr><th>Serial Number</th><th>Model</th><th>Type</th><th>Location</th><th>Color</th><th>HourlyRate</th><th>DiscountedRate (Frequent)</th><th>DiscountedRate (Daily)</th><th>DailyRate</th><th>Seats</th><th>Transmission</th><th>Buetooth</th><th>Aux</th><th>Abailable Till</th><th>Estimated Cost</th></tr>';

	  while($row = mysql_fetch_row($result)) {
	  echo '<tr>';
	  foreach($row as $key=>$value) {
	  echo '<td>',$value,'</td>';
	  }
	  echo '</tr>';
	  }
	  echo '</table><br />';
}  













else if ($_POST['chooseby'] == 'bymodel')
{
        $SRModel=$_POST['choose'];
	  $query = "SELECT SerialNumber, Model, Type, LocationName AS 'Location', Color, HourlyRate, HourlyRate*0.9 AS 'DiscountedRate (Frequent)', HourlyRate*0.85 AS 'DiscountedRate (Daily)', DailyRate, Seats, Transmission, Bluetooth, Aux, AvailableTill, FORMAT(HourlyRate*'$UserPlanDiscount'*'$SRResvTime', 2) AS 'Estimated Cost'
	FROM
	((Car c)
	INNER JOIN
	(SELECT SNumber, MIN(PickupTime) AS AvailableTill
	FROM (
	(
	SELECT DISTINCT SerialNumber AS SNumber, LocationName AS LName
	FROM Car
	WHERE SerialNumber NOT IN (
	SELECT DISTINCT SerialNumber
	FROM Reservation
	WHERE (SerialNumber, PickupTime, ReturnTime) NOT IN (
	SELECT SerialNumber, PickupTime, ReturnTime
	FROM Reservation
	WHERE ReturnTime<'$SRPickupTime' OR PickupTime >'$SRReturnTime'))
	AND LocationName='$SRLocationName' AND Model='$SRModel'
	AND Flag=1
	) available_car
	LEFT OUTER JOIN 
	(
	SELECT * FROM
	Reservation 
	WHERE PickupTime > '$SRReturnTime' AND FORMAT(TIMESTAMPDIFF(SECOND, '$SRReturnTime', PickupTime)/3600, 2) <= 12
	)resv
	ON available_car.SNumber = resv.SerialNumber AND available_car.LName = resv.LocationName )
	GROUP BY(SNumber) ) ac ON c.SerialNumber = ac.SNumber ); ";

	  $result = mysql_query($query);


	  echo '<h1>Car Availability</h1>';

	  echo '<table align="center" cellpadding="0" cellspacing="0" class="db-table">';
	  echo '<tr><th>Serial Number</th><th>Model</th><th>Type</th><th>Location</th><th>Color</th><th>HourlyRate</th><th>DiscountedRate (Frequent)</th><th>DiscountedRate (Daily)</th><th>DailyRate</th><th>Seats</th><th>Transmission</th><th>Buetooth</th><th>Aux</th><th>Abailable Till</th></tr>';
	  while($row = mysql_fetch_row($result)) {
	  echo '<tr>';
	  foreach($row as $key=>$value) {
	  echo '<td>',$value,'</td>';
	  }
	  echo '</tr>';
	  }
	  echo '</table><br />';


}
?>

  </body>
</html>

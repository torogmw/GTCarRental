<?php
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



$query = "
INSERT INTO Car(SerialNumber, Model, Type, LocationName, Color, HourlyRate,DailyRate, Seats,Transmission, Bluetooth, Aux, Flag
)
VALUES (
'$_GET[SerialNumber]', 
'$_GET[Model]', 
'$_GET[Type]',
'$_GET[LocationName]',
'$_GET[Color]',
'$_GET[HourlyRate]',
'$_GET[DailyRate]',
'$_GET[Seats]',
'$_GET[Transmission]',
'$_GET[Bluetooth]',
'$_GET[Aux]', 
'$_GET[Flag]'
)";

$array = array("SerialNumber", "Model", "Type", "LocationName", "Color", "HourlyRate","DailyRate", "Seats","Transmission", "Bluetooth", "Aux", "Flag");
$result = mysql_query ($query) or die(mysql_error());

$SerialNumber=$_GET[SerialNumber];

$query = "SELECT * FROM Car WHERE SerialNumber=$SerialNumber";
$result = mysql_query ($query) or die(mysql_error());


if (mysql_num_rows($result) == 1) {
 echo '<h1>A New Car is Added!</h1>';
 echo '<h2>The information of the new car is:</h2>';

 echo '<table align="center" cellpadding="0" cellspacing="0" class="db-table">';
  echo '<tr><th>Serical Number</th><th>Model</th><th>Type</th><th>Location Name</th><th>Color</th><th>Hourly Rate</th><th>Daily Rate</th><th>Seat Capacity</th><th>Transmission</th><th>Bluetooth</th><th>Aux Cable</th><th>Avaialbility</th></tr>';
//  while($row = mysql_fetch_row($result)) {
//  echo '<tr>';
//  foreach($row as $key=>$value) {
//  echo '<td>',$value,'</td>';
//  }
//  echo '</tr>';
//  }
//  echo '</table><br />';
  $row=  mysql_fetch_array($result);
  echo '<tr>';
  foreach($array as $value) {
  echo '<td>',$row{$value},'</td>';
  }
  echo '</tr>';
  echo '</table><br />';
 
}

?>

 <p>Back to <a href="manage_car.php">Manage Car</a></p>

</body>
</html>
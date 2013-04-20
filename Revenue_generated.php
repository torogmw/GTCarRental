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

  #session_start();
  
  mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());

  mysql_select_db($database) or die ("Unable to select database");

  $query = "
SELECT SerialNo, Model, Type, ReservationRevenue,LateFeesRevenue
FROM
(
(
SELECT
SerialNumber AS SerialNo, SUM(EstimatedCost) AS
ReservationRevenue, SUM(LateFees) AS LateFeesRevenue
FROM Reservation r
WHERE (
(MONTH(PickupTime) = (SELECT DISTINCT MONTH(CURDATE())-1
FROM Reservation))
OR
(MONTH(PickupTime) = (SELECT DISTINCT MONTH(CURDATE())-2
FROM Reservation))
OR
(MONTH(PickupTime) = (SELECT DISTINCT MONTH(CURDATE())-3
FROM Reservation))
AND
(YEAR(PickupTime) = (SELECT DISTINCT YEAR(CURDATE()) FROM
Reservation))
)
GROUP BY r.SerialNumber
) revn
INNER JOIN
Car c
ON c.SerialNumber=revn.SerialNo
)";

  $result = mysql_query($query);

  echo mysql_num_rows($result);

  echo '<h1>Location Preference Report</h1>';

  echo '<table align="center" cellpadding="0" cellspacing="0" class="db-table">';
  echo '<tr><th>Serial No</th><th>Model</th><th>Type</th><th>Reservation Revenue</th><th>Late Fees Revenue</th></tr>';
  while($row = mysql_fetch_row($result)) {
  echo '<tr>';
  foreach($row as $key=>$value) {
  echo '<td>',$value,'</td>';
  }
  echo '</tr>';
  }
  echo '</table><br />';

?>

  </body>
</html>

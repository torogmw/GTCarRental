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

$query="SELECT MONTH(CURDATE())-1 as cur;";
$result=mysql_query($query) or die ("Unable to select database");
$row = mysql_fetch_array($result);
echo "(curdate.month-1)=".$row['cur']."<br>";

  $query = "
SELECT DISTINCT ResvMonth, LocationName, TotalResv,TotalHour
FROM (
SELECT MONTH(PickupTime) AS ResvMonth, LocationName, PickupTime, COUNT(*) AS TotalResv,
	SUM(FORMAT(TIMESTAMPDIFF(SECOND,PickupTime,ReturnTime)/3600,2) ) AS TotalHour
FROM Reservation
WHERE ( MONTH(PickupTime) = (SELECT DISTINCT MONTH(CURDATE())-1 FROM Reservation)
        OR (MONTH(PickupTime) = (SELECT DISTINCT MONTH(CURDATE())-2 FROM Reservation))
        OR (MONTH(PickupTime) = (SELECT DISTINCT MONTH(CURDATE())-3 FROM Reservation))
        AND (YEAR(PickupTime) = (SELECT DISTINCT YEAR(CURDATE())  FROM Reservation)))
GROUP BY MONTH(PickupTime), LocationName
) resvcount
INNER JOIN 
(
SELECT DISTINCT MAX(TotalResv) AS ResvMax
FROM  
(
SELECT MONTH(PickupTime) AS ResvMonth, LocationName, PickupTime, COUNT(*) AS TotalResv,
	SUM(FORMAT(TIMESTAMPDIFF(SECOND,PickupTime,ReturnTime)/3600,2) ) AS TotalHour
FROM Reservation
WHERE ( MONTH(PickupTime) = (SELECT DISTINCT MONTH(CURDATE())-1 FROM Reservation)
        OR (MONTH(PickupTime) = (SELECT DISTINCT MONTH(CURDATE())-2 FROM Reservation))
        OR (MONTH(PickupTime) = (SELECT DISTINCT MONTH(CURDATE())-3 FROM Reservation))
        AND (YEAR(PickupTime) = (SELECT DISTINCT YEAR(CURDATE())  FROM Reservation)))
GROUP BY MONTH(PickupTime), LocationName
) count
GROUP BY MONTH(PickupTime)
) maxresv
ON resvcount.TotalResv=maxresv.ResvMax
	;";

  $result = mysql_query($query) or die(mysql_error());;

  echo mysql_num_rows($result);

  echo '<h1>Location Preference Report</h1>';

  echo '<table align="center" cellpadding="0" cellspacing="0" class="db-table">';
  echo '<tr><th>Month</th><th>Location</th><th>No of Reservations</th><th>Total no of hours</th></tr>';
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

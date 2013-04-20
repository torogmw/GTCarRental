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

  session_start();
  
  mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());

  mysql_select_db($database) or die ("Unable to select database");

  $query = "
  SELECT Car, Time AS 'Date-time', UserName AS 'Employee', Problems AS 'P	roblem'
  FROM
  (
  (
  SELECT *
  FROM 
  MaintenanceRequest
  ) mt
  INNER JOIN
  (
  SELECT SerialNumber AS SNumber, Model AS Car, Time AS T, UserName AS UN	, COUNT(Problems) AS Count
  FROM
  (
  (
  SELECT SerialNumber AS SN, Model
  FROM Car 
  ) c
  INNER JOIN
  MaintenanceRequest mr
  ON c.SN = mr.SerialNumber
  )
  GROUP BY SerialNumber, Time
  ) mc
  ON mt.SerialNumber=mc.SNumber AND mt.Time=mc.T

  )
  ORDER BY Count DESC, SerialNumber, Time";

  $result = mysql_query($query);

  #echo mysql_num_rows($result);

  echo '<h1>Maintenance Request Report</h1>';

  echo '<table align="center" cellpadding="0" cellspacing="0" class="db-table">';
  echo '<tr><th>Car</th><th>Date-time</th><th>Employee</th><th>Problem</th></tr>';
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
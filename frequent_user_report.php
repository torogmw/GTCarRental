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

  $query = "SELECT UserName, PlanName, ResvNo
  FROM
  (
  (SELECT UserName As Name, Count(*) AS ResvNo
  FROM Reservation
  GROUP BY UserName) resv
  INNER JOIN
  Member
  ON UserName=Name
  ) 
  ORDER BY ResvNo DESC
  LIMIT 5";

  $result = mysql_query($query);

  
  echo mysql_num_rows($result);

  echo '<h1>Frequent Users Report</h1>';

  echo '<table align="center" cellpadding="0" cellspacing="0" class="db-table">';
  echo '<tr><th>Username</th><th>Driving Plan</th><th>No of Reservations Per Month</th></tr>';
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
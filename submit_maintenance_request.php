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

//mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());

//mysql_select_db($database) or die ("Unable to select database");

$LocationName = $_GET[current_location];
$Model = $_GET[car];//$_GET[car];
date_default_timezone_set('America/New_York');
$time = date('Y-m-d h:i:s', time());





$query = "SELECT SerialNumber FROM Car WHERE LocationName = '$LocationName' and Model = '$Model'";
$result = perform_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);
$SerialNumber = $row["SerialNumber"];

$problem1 = $_GET[problem1];
$problem2 = $_GET[problem2];
$problem3 = $_GET[problem3];

if ($problem1 !=""){
    $queryInsert = "
    INSERT INTO MaintenanceRequest(SerialNumber, Problems, Time, UserName)
    VALUES (
    '$SerialNumber', 
    '$_GET[problem1]', 
    '$time',
    'Lucy'
    )";
    $queryUpdate = "UPDATE Car SET Flag=0 WHERE SerialNumber = $SerialNumber";
    mysql_query ($queryInsert) or die(mysql_error());    
}

if ($problem2 !=""){
    $queryInsert = "
    INSERT INTO MaintenanceRequest(SerialNumber, Problems, Time, UserName)
    VALUES (
    '$SerialNumber', 
    '$_GET[problem2]', 
    '$time',
    'Lucy'
    )";
    $queryUpdate = "UPDATE Car SET Flag=0 WHERE SerialNumber = $SerialNumber";
    mysql_query ($queryInsert) or die(mysql_error());    
}

if ($problem3 !=""){
    $queryInsert = "
    INSERT INTO MaintenanceRequest(SerialNumber, Problems, Time, UserName)
    VALUES (
    '$SerialNumber', 
    '$_GET[problem3]', 
    '$time',
    'Lucy'
    )";
    $queryUpdate = "UPDATE Car SET Flag=0 WHERE SerialNumber = $SerialNumber";
    mysql_query ($queryInsert) or die(mysql_error());    
}

mysql_query ($queryUpdate) or die(mysql_error());       // flag set to 0 make this car inavailable
echo "<h1>maintenance request submitted, cars not available to show up agaian!</h1>";

?>

 <h2><p>Back to <a href="maintenance_request.php">maintenance request</a></p></h2>

</body>
</html>

<?php
   function get_and_print_options($query, $column) {
   $results = perform_query($query);
   while ($row = mysql_fetch_array($results)) {
   $choice = $row[$column];
   ?>
<option value="<?=$choice ?>"><?= $choice ?></option>
<?php
   }
   }
   ?>

<?php
   function perform_query($query) {
   include 'dbinfo.php';
   mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());
   mysql_select_db($database) or die ("Unable to select database");

   $results = mysql_query($query);
   
   return $results;
   }
?>
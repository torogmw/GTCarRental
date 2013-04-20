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

#echo $_GET[current_location];
#echo $_GET[car];
#echo $_GET[new_location];

mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());

mysql_select_db($database) or die ("Unable to select database");


$query = " UPDATE Car SET LocationName='$_GET[new_location]'
WHERE LocationName='$_GET[current_location]' AND Model='$_GET[car]'";
$result=mysql_query($query);

$query = "SELECT LocationName From Car WHERE LocationName='$_GET[new_location]' AND Model='$_GET[car]'";
$result=mysql_query($query);



  if(mysql_num_rows($result)==1) {
    echo '<h1>Location Update Succeeded :) !</h1>';
    echo '<p> Move <strong>';
    echo $_GET[car]; 
    echo '</strong> from <strong>';
    echo $_GET[current_location];
    echo '</strong> to <strong>' ;
    echo $_GET[new_location];
    echo '</strong></h2>';
  }

else
    echo '<h1>Location Update Failed T.T !</h1>';
  
?>


  </body>
</html>
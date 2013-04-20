<?php
include('dbinfo.php');
if($_POST['LocationName'])
{
$LocationName=$_POST['LocationName'];
	include('dbinfo.php');
	mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());

  	mysql_select_db($database) or die ("Unable to select database");
$sql=mysql_query("SELECT Model from Car WHERE LocationName='$LocationName'");
while($row=mysql_fetch_array($sql))
{
$LocationName=$row['LocationName'];
$Model=$row['Model'];
echo '<option value="'.$Model.'">'.$Model.'</option>';
}
}
?>
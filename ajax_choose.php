<?php
include('dbinfo.php');
if($_POST['chooseby'])
{
	$chooseby=$_POST['chooseby'];
	include('dbinfo.php');
	mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());
  	mysql_select_db($database) or die ("Unable to select database");
	if ($chooseby=='bytype') 
	{
		$sql=mysql_query("SELECT DISTINCT Type from Car");
		while($row=mysql_fetch_array($sql))
		{
			$value=$row['Type'];
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
	} else if ($chooseby=='bymodel') {
		$sql=mysql_query("SELECT DISTINCT Model from Car");
		while($row=mysql_fetch_array($sql))
		{
			$value=$row['Model'];
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
	}


}
?>

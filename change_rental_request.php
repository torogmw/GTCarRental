<?php
include 'dbinfo.php';

mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());
mysql_select_db($database) or die ("Unable to select database");
//$UserName = $_SESSION['UserName'];
# !!!

$query = "SELECT CURDATE() as curdate";
$result= mysql_query ($query);
$day0=mysql_fetch_array($result);
$query = "SELECT CURDATE()+interval 1 day as curdate1";
$result= mysql_query ($query);
$day1=mysql_fetch_array($result);
$query = "SELECT CURDATE()+interval 2 day as curdate2";
$result= mysql_query ($query);
$day2=mysql_fetch_array($result);
$query = "SELECT CURDATE()+interval 3 day as curdate3";
$result= mysql_query ($query);
$day3=mysql_fetch_array($result);
$query = "SELECT CURDATE()+interval 4 day as curdate4";
$result= mysql_query ($query);
$day4=mysql_fetch_array($result);

$query = "SELECT LocationName FROM Location";
$location_result= mysql_query ($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- HTML Codes by Quackit.com -->
<title>
Rental Change Request</title>
<meta name="description" content="Employees need to use this option when a member calls the GTCR customer care informing them that he is going to be late.">
<style type="text/css">
body {background-color:ffffff;background-image:url(http://);background-repeat:no-repeat;background-position:top left;background-attachment:fixed;}
h1{text-align:center;font-family:Arial;color:000000;}
p {font-family:Arial;font-size:14px;font-style:normal;font-weight:normal;color:000000;}
</style>
</head>
<body>
<h1>Rental Change Request</h1>
     <div id="container">
	<div id="change">
	  <h2>Change Cars rental</h2>
	  <form action="change_rental.php">
            <label class="heading"> Enter Username: </label>
	    <input type="text" name="SerialNumber"/> 
            <input type="submit" value="search" /><br/>
	    <label class="heading">Car Model: </label> 
	    <table type="text" name="Model" /> <br/>	   
	    <label class="heading">Location: </label>
            <table type="text" name="Location" /> <br/>
	    <label class="heading">Original Time: </label>
            <table type="text" name="OriginalTime" /> <br /> 
            <label class="extendedtime" for="extendedtime">Extended Time:</label>
            <select name="date">
	      	  <option value="<?php echo $day0['curdate'];?>" ><?php echo $day0['curdate'];?> </option>
                  <option value="<?php echo $day1['curdate1'];?>" ><?php echo $day1['curdate1'];?> </option>
                  <option value="<?php echo $day2['curdate2'];?>" ><?php echo $day2['curdate2'];?> </option>
            </select> 
            <select name="time"> 
    <SCRIPT Language="JavaScript">
	<!-- 
	for (i=0;i<24;i++) {
	if (i<10) {zero="0"} else {zero=""};
	document.write('<option value="'+zero+i+':00:00">')
	document.write(i+':00</option>')
	document.write('<option value="'+zero+i+':30:00"">')
	document.write(i+':30</option>')
	}
	//-->
   </SCRIPT>
   </select><br />
            
	    <input type="submit" value="update" />
      
	  </form>
	</div>
        <div id="affected"> 
            <h2>Users Affected</h2>
            <label class="heading"> Username: </label>
	    <table type="text" name="UserName" /> <br/>
	    <label class="heading"> Pickup Time: </label> 
	    <table type="text" name="PickupTime" /> <br/>	   
	    <label class="heading">Return Time: </label>
            <table type="text" name="ReturnTime" /> <br/>
	    <label class="heading">Email Address: </label>
            <table type="text" name="Email" /> <br /> 
            <label class="heading">Phone: </label>
            <table type="text" name="Phone" /> <br /> 
            <input type="submit" value="Cancel" />
            <input type="submit" value="View Car Availability" /> <br />
            
        </div>
</div>



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



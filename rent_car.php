<?php
include 'dbinfo.php';

mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());
mysql_select_db($database) or die ("Unable to select database");
//$UserName = $_SESSION['UserName'];
# !!!
$User ='Kim';
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

//$locationname=mysql_fetch_array($result);
//$location_num=mysql_num_rows($result);
//echo "show1: ".$locationname[0];

/*
$i=0;
while($row = mysql_fetch_array($result)) {
	$location[$i]=$row['LocationName'];
	echo "show location: ".i."  ".$location_num[$i];
	$i=$i+1;
}
echo "show location1: ".$location_num[0];
*/
?>




<html>

<head>
<title>Rent a Car</title>
</head>

 <body>
  <h1>Rent a Car</h1>

  <form name ="form1" Method ="Post" action="car_availab.php">
   <label class="pickuptime" for="pickuptime">Pick Up Time:</label>
   <select name="PickupDate">
	  <option value="<?php echo $day0['curdate'];?>" ><?php echo $day0['curdate'];?> </option>
	  <option value="<?php echo $day1['curdate1'];?>" ><?php echo $day1['curdate1'];?> </option>
	  <option value="<?php echo $day2['curdate2'];?>" ><?php echo $day2['curdate2'];?> </option>
   
   </select>
  	
   <select name="PickupTime"> 

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
   </select>
   <br />

   <label class="returntime" for="returntime">Return Time:</label>

   <select name="ReturnDate">
	  <option value="<?php echo $day0['curdate'];?>" ><?php echo $day0['curdate'];?> </option>
	  <option value="<?php echo $day1['curdate1'];?> " ><?php echo $day1['curdate1'];?> </option>
	  <option value="<?php echo $day2['curdate2'];?>" ><?php echo $day2['curdate2'];?> </option>
	  <option value="<?php echo $day3['curdate3'];?> " ><?php echo $day3['curdate3'];?> </option>
	  <option value="<?php echo $day4['curdate4'];?> " ><?php echo $day4['curdate4'];?> </option>
   
   </select>
  	
   <select name="ReturnTime"> 

	<SCRIPT Language="JavaScript">
	<!-- 
	for (i=0;i<24;i++) {
	document.write('<option value="returndate'+i*2+'">')
	document.write(i+':00</option>')
	document.write('<option value="returntime'+(i*2+1)+'">')
	document.write(i+':30</option>')
	}
	//-->

	</SCRIPT>
   
   </select> <br />

 <label class="locationname" for="locationname">Location:</label>
 <select name="location">
	<?php
	$i=0;
	while ($row=mysql_fetch_array($location_result))
	{
	echo '<option value="location'.$i.'">'.$row['LocationName'].'</option>';
	$i=$i+1;
	}
	?>
 </select><br />



 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	    <script type="text/javascript">
	      $(document).ready(function()
	      {
	      $(".chooseby").change(function()
	      {
	      var chooseby=$(this).val();
	      var dataString = 'chooseby='+ chooseby;

	      $.ajax
	      ({
	      type: "POST",
	      url: "ajax_choose.php",
	      data: dataString,
	      cache: false,
	      success: function(html)
	      {
	      $(".choose").html(html);
	      } 
	      });
	      });
	      });
	    </script>


<label name="choosebylable" class="choosebylable">Pick Up Time:</label> 

   <select name="chooseby" class="chooseby">
	  <option value="by" >-- Choose by -- </option>
	  <option value="bytype" >Choose by Type </option>
	  <option value="bymodel" >Choose by Model</option>  
   </select>

   <select name="choose" class="choose">
	 <option selected="selected">----</option>
   </select>

  <br /> <br />

  <input type="submit" value="search" />

  </form>
 </body>
</html>

<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$(".current_location").change(function()
{
var LocationName=$(this).val();
var dataString = 'LocationName='+ LocationName;

$.ajax
({
type: "POST",
url: "ajax_car.php",
data: dataString,
cache: false,
success: function(html)
{
$(".car").html(html);
} 
});

});

});
</script>
<html>
<body>

Choose Current Location :
<select name="current_location" class="current_location">
<option selected="selected">--Choose Current Location--</option>
<?php
	include('dbinfo.php');
	mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());

  	mysql_select_db($database) or die ("Unable to select database");

	$sql=mysql_query("SELECT DISTINCT LocationName FROM Location ORDER BY LocationName");
while($row=mysql_fetch_array($sql))
{
$data=$row['LocationName'];
echo '<option value="'.$data.'">'.$data.'</option>';
} ?>
</select> <br/><br/>

Car :
<select name="car" class="car">
<option selected="selected">--Select Car--</option>
</select>

Car Type:
<

</body>
</html>


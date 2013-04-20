<html>

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
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="manage_car_style.css" type="text/css" media="all" />
</head>
<body>

<div id="header"><h1>Maintenance Request</h1></div>
<div id="request"> 
    <form action="submit_maintenance_request.php" method="get">
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
        } 
?>
</select> <br/><br/>

<select name="car" class="car">
<option selected="selected">--Select Car--</option>
</select> <br>

Brief Description of Problem: <br>
1: <input type="text" name="problem1"><br>
2: <input type="text" name="problem2"><br>
3: <input type="text" name="problem3"><br>

<input type="Submit" Name = "submit_request" value="Submit Request">
</form>
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
   




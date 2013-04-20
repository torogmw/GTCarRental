
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="manage_car_style.css" type="text/css" media="all" />
</head>
  <body>

    <div id="wrapper">

      <div id="header"><h1>Manage Cars</h1></div>

      <div id="container">
	<div id="add">
	  <h2>ADD CARS</h2>
	  <form action="add_car.php">

            <label class="heading"> Serial Number: </label>
	    <input type="text" name="SerialNumber" /> <br />
	    
	    <label class="heading">Car Model: </label> 
	    <input type="text" name="Model" /> <br />
	    
	    <label class="heading">Car Type: </label>
	    <select name="Type">
	      <option selected="selected">--Choose Car Type--</option>
	      <?php
		 $query = "SELECT DISTINCT Type FROM Car";
		 get_and_print_options($query, "Type");
		 ?>
	    </select> <br />
	    
	    <label class="heading">Location: </label>
	    <select name="LocationName">
	      <option selected="selected">--Choose Location--</option>
	      <?php
		   $query = "SELECT DISTINCT LocationName FROM Location ORDER BY LocationName";
		   get_and_print_options($query, "LocationName");
		   ?>
	    </select> <br />

	    <label class="heading">Color: </label>
	    <input type="text" name="Color" /> <br />
	    
	    <label class="heading">Hourly Rate: </label>
	    <input type="text" name="HourlyRate" /> <br />
	    
	    <label class="heading">Daily Rate: </label>
	    <input type="text" name="DailyRate" /> <br />
	    
	    <label class="heading">Seating Capacity: </label>
	    <input type="text" name="Seats" /> <br />

	    <label class="heading">Transmission: </label>
	    <select name="Transmission">
	      <option>Auto</option>
	      <option>Manual</option>
	    </select> <br />
	    
	    <label class="heading">Bluetooth Connectivity: </label>
	    <select name="Bluetooth">
	      <option value="0">No</option>
	      <option value="1">Yes</option>
	    </select> <br /> <br />
	    
	    <label class="heading">Auxiliary Cable: </label>
	    <select name="Aux">
	      <option value="1">Yes</option>
	      <option value="0">No</option>
	    </select> <br />
	    
	    <label class="heading">Ready for Rental: </label>
	    <select name="Flag">
	      <option value="1">Yes</option>
	      <option value="0">No</option>
	    </select> <br /> <br />
	    
	    <input type="submit" value="ADD" />
      
	  </form>
	</div>


	<div id="change">
	  <h2>CHANGE CAR LOCATION</h2>
	  
	  <form action="change_car_location.php" method="get">
	    <div>
	      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
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
	      <label class="heading">Choose Current Location: </label>
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
	      </select> <br/> <br/>
	      
	      <label class="heading">Car: </label>
	      <select name="car" class="car">
		<option selected="selected">--Select Car--</option>
	      </select> <br /><br />
	    </div>
	    <div>
	      <label class="heading">Choose New Location: </label>
	      <select name="new_location">
		<option selected="selected">--Choose New Location--</option>
		<?php
		   $query = "SELECT DISTINCT LocationName FROM Location ORDER BY LocationName";
		   get_and_print_options($query, "LocationName");
		   ?>
	      </select><br /><br />
	    </div>
	    <input type="submit" value="Submit Change" />
	  </form>
          <form action="employee_homepage.php" method="get">
            <input type="submit" value="Back to Homepage" />
          </form>      
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
?>
   


<?php
include 'dbinfo.php';
session_start();

mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());
mysql_select_db($database) or die ("Unable to select database");
//$UserName = $_SESSION['UserName'];
# !!!
$User =$_SESSION['UserName'];
# !!!
$query = "SELECT * FROM Member WHERE UserName='$User'";
$result= mysql_query ($query) or die(mysql_error());
$row=mysql_fetch_array($result);
$CardNumberOld=$row['CardNumber'];
$query = "SELECT * FROM PaymentInfo WHERE CardNumber='$CardNumberOld'";
$result= mysql_query ($query) or die(mysql_error());
$row1=mysql_fetch_array($result);
?>


<?php
if (isset($_POST['Edit'])) {

mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());
mysql_select_db($database) or die ("Unable to select database");

$selected_radio = $_POST['plan'];

if ($selected_radio ==  'Occa') {
$PlanName='Occasional Driving';
}
else if ($selected_radio == 'Freq') {
$PlanName='Frequent Driving';
}
else if ($selected_radio == 'Daily') {
$PlanName='Daily Driving';
}

$FirstName=$_POST['FirstName'];
$MiddleInitial=$_POST['MiddleInitial'];
$LastName=$_POST['LastName'];
$Email=$_POST['Email'];
$Phone=$_POST['Phone'];

$Name=$_POST['Name'];

$CardNumberOld=$row1['CardNumber'];
$CardNumberNew=$_POST['CardNumber'];

$CVV=$_POST['CVV'];
$ExpiryDate=$_POST['ExpiryDate'];
$Address=$_POST['Address'];

//update database according to input
$query = "UPDATE Member SET FirstName='$FirstName', MiddleInitial='$MiddleInitial', LastName='$LastName', Email='$Email', Phone='$Phone',PlanName='$PlanName' WHERE UserName='$User'";
$result= mysql_query ($query);

$query="DELETE FROM PaymentInfo WHERE CardNumber='$CardNumberOld'";
$result=mysql_query ($query) ;
$query="INSERT INTO PaymentInfo (CardNumber, Name, Address, CVV, ExpiryDate) VALUES ('$CardNumberNew', '$Name', '$Address', '$CVV','$ExpiryDate')";
$result=mysql_query ($query) ;
$query="UPDATE Member SET CardNumber='$CardNumberNew' WHERE UserName='$User'";
$result=mysql_query ($query) ;

// display new values
$query = "SELECT * FROM Member WHERE UserName='$User'";
$result= mysql_query ($query) or die(mysql_error());
$row=mysql_fetch_array($result);
$CardNumberOld=$row['CardNumber'];
$query = "SELECT * FROM PaymentInfo WHERE CardNumber='$CardNumberOld'";
$result= mysql_query ($query) or die(mysql_error());
$row1=mysql_fetch_array($result);
}
?>



<style>

  h1 {
  text-align: center;
  font-size: 20px;
  }
  h2 {
  font-size: 15px;
  }  

  fieldset {
  backgroud-color: #ffffcc;
  margin-left: auto; margin-right: auto;
  width: 25em;
  }
  


</style>

<html>
<head>
<title>Person Information</title>
</head>

 <body>
   
  <h1>General Information</h1>
  <h1><?php echo "Hey $User, please edit your personal information"; ?></h1>
  <form name ="form1" Method ="Post" action="person_info.php">
    <fieldset>
      <div>
  	<h1>Personal Information</h1>
	<label class="heading" for="FirstName">First Name:</label>
	<input type="text" name="FirstName" value="<?php echo $row['FirstName']; ?>"> <br />
	<label class="heading" for="MiddleInitial" >Middle Initial:</label>
	<input type="text" name="MiddleInitial" value="<?php echo $row['MiddleInitial']; ?>" /> <br />
	<label class="heading" for="LastName">Last Name:</label>
	<input type="text" name="LastName" value="<?php echo $row['LastName']; ?>"/> <br />
	<label class="heading" for="Email">Email Address:</label>
	<input type="text" name="Email" value="<?php echo $row['Email']; ?>"> <br />
	<label class="heading" for="Phone">Phone Number:</label>
	<input type="text" name="Phone" value="<?php echo $row['Phone']; ?>"> <br />
     </div>

    </fieldset>

  <fieldset>
	<div>
	<h1>Membership Information</h1>
	<div>
        <h2>CHOOSE A PLAN: (now: <?php echo $row['PlanName'] ?>) </h2>
	</div>
	<Input type = 'Radio' Name ='plan' value= 'Occa'>Occasional Driving <br />
	<Input type = 'Radio' Name ='plan' value= 'Freq'>Frequent Driving <br />
	<Input type = 'Radio' Name ='plan' value= 'Daily'>Daily Driving <br />

        </div>
  </fieldset>

  <fieldset>
	<h1>Membership Information</h1>
	<label class="heading" for="Name">Name on the card:</label>
	<input type="text" name="Name" value="<?php echo $row1['Name']; ?>"> <br />
	<label class="heading" for="CardNumber" >Card Number:</label>
	<input type="text" name="CardNumber" value="<?php echo $row1['CardNumber']; ?>" /> <br />
	<label class="heading" for="CVV">CVV:</label>
	<input type="text" name="CVV" value="<?php echo $row1['CVV']; ?>"/> <br />
	<label class="heading" for="ExpiryDate">Expiry date (yyyy-mm-dd):</label>
	<input type="text" name="ExpiryDate" value="<?php echo $row1['ExpiryDate']; ?>"> <br />
	<label class="heading" for="Address">Billing Address:</label>
	<input type="text" name="Address" value="<?php echo $row1['Address']; ?>"> <br />

	<input type="Submit" Name = "Edit" value="Update"/>
  </fieldset>
  <h1>
     <a href="member_homepage.php">back</a>
  </h1>
 </body>
</html>

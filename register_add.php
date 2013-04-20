<?php
  include 'dbinfo.php';
?>


<?php

mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());

mysql_select_db($database) or die ("Unable to select database");


$UserName = mysql_real_escape_string($_POST['UserName']);
$Password = mysql_real_escape_string($_POST['Password']);
$PasswordConfirm = mysql_real_escape_string($_POST['PasswordConfirm']);
#echo $UserName;
#echo $Password;
#echo $UserType;
if ($Password == $PasswordConfirm) {
$query = "INSERT INTO User (UserName, Password) VALUES ('$_POST[UserName]', '$_POST[Password]')";

$result = mysql_query ($query) or die(mysql_error());
#$echo $result;
if ($_POST[UserType]=="Member"){
$query = "INSERT INTO $_POST[UserType] (UserName, FirstName, MiddleInitial, LastName, Email, Phone, Address, PlanName, CardNumber) VALUES ('$_POST[UserName]', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null')";
}
if ($_POST[UserType]=="Employee"){
$query = "INSERT INTO $_POST[UserType] (UserName) VALUES ('$_POST[UserName]')";    
}
#echo $query;


$result = mysql_query ($query) or die(mysql_error());

#echo $result;



echo "<html><body><h1>Congratulations!</h1><p1>Your Account is Successfully Created!</p><p2>Please <a href='index.php'>Log in</a></body></html>";
}

if ($Password != $PasswordConfirm) {
echo "<html><body><h1>Sorry!</h1><p1>Your typed Password incorrectly!</p><p2>Please <a href='register.php'>register again</a></body></html>";
}
    
?>
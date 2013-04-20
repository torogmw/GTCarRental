<?php
include 'dbinfo.php';

session_start();

$_SESSION['UserName']=$_POST['UserName'];
$_SESSION['Password']=$_POST['Password'];

#echo $_SESSION['UserName'];
#echo $_SESSION['Password'];

#echo $host;
#echo $UserName;
#echo $Password;
#echo $database;

mysql_connect($host,$dbUserName,$dbPassword) or die ("Unable to connect: ".mysql_error());

mysql_select_db($database) or die ("Unable to select database");

$UserName = $_SESSION['UserName'];
$Password = $_SESSION['Password'];

#echo $UserName;
#echo $Password;

$query = "SELECT * FROM User WHERE UserName='$UserName' AND Password='$Password'";


$result = mysql_query ($query) or die(mysql_error());

if(mysql_num_rows($result) == 1) {
   //Login Successful

   $query = "SELECT * FROM Member WHERE UserName='$UserName'";
   $result = mysql_query ($query) or die(mysql_error());

   if(mysql_num_rows($result) == 1) {
   $_SESSION['UserType'] = "Member";
   header('Location: member_homepage.php');
   }

   $query = "SELECT * FROM Employee WHERE UserName='$UserName'";
   $result = mysql_query ($query) or die(mysql_error());

   if(mysql_num_rows($result) == 1) {
   $_SESSION['UserType'] = "Employee";
   header('Location: employee_homepage.php');
   }

   $query = "SELECT * FROM Administrator WHERE UserName='$UserName'";
   $result = mysql_query ($query) or die(mysql_error());

   if(mysql_num_rows($result) == 1) {
   $_SESSION['UserType'] = "Administrator";
   header('Location: admin_menu.php');
   }

   session_regenerate_id();
   
   }else{
   $err = 'User Name or Password incorrect!!';
   }

  echo $err;
  
?>

<html>
<body>


</body>
</html>
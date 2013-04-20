<?PHP
include 'dbinfo.php';

session_start();

$UserName = $_SESSION['UserName'];
# $Password = $_SESSION['Password'];


if (isset($_POST['Submit1'])) {

$selected_radio = $_POST['operation'];

if ($selected_radio ==  'rent') {

   header('Location: rent_car.php');

}
else if ($selected_radio == 'view_person_info') {

   header('Location: person_info.php');

}
else if ($selected_radio == 'view_rental_info') {

   header('Location: rental_info.php');

}

}



echo"<html><head><title>Employee Homepage</title></head><body>";
echo "Hello $UserName, Welcome back!";
echo"<Form name ='form1' Method ='Post' ACTION ='member_homepage.php'>";
echo"<Input type = 'Radio' Name ='operation' value= 'rent'>Rent a Car<br />";
echo"<Input type = 'Radio' Name ='operation' value= 'view_person_info'>Enter/View Personal Information <br />";
echo"<Input type = 'Radio' Name ='operation' value= 'view_rental_info'>View Rental Information<br />";
echo"<P><Input type = 'Submit' Name = 'Submit1' Value = 'Next'></FORM></body></html>";

?>


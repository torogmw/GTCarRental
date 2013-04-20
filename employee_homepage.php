<?PHP
include 'dbinfo.php';
session_start();
$UserName = $_SESSION['UserName'];

if (isset($_POST['Submit1'])) {

$selected_radio = $_POST['operation'];
$selected_option = $_POST['operation2'];

if ($selected_radio ==  'car_management') {

   header('Location: manage_car.php');

}
else if ($selected_radio == 'maintenance_request') {

   header('Location: maintenance_request.php');

}
else if ($selected_radio == 'change_rental_request') {

   header('Location: change_rental_request.php');

}
else if ($selected_radio == 'view_reports') {
   #header('Location: location_pref_report.php'); 
   if ( $selected_option == 'location_preference' ) {
       header('Location: location_preference.php');
   }
   else if ($selected_option == 'maintenance_preference') {
       header('Location: maintenance_preference.php');
   }
   else if ($selected_option == 'frequent_user') {
       header('Location: frequent_user.php');
   }
   else if ($selected_option == 'administrationm_request') {
       header('Location: administrationm_request.php');
   }
       
}
}



echo"<html><head>";
echo"<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
echo"<link rel='stylesheet' href='employee_homepage_style.css' type='text/css' media='all' /></head>";
echo"<body> <div id='wrapper'><div id='header'><h1>Employee Homepage</h1>Employee $UserName, at your service</div>";
echo"<Form name ='form1' Method ='Post' ACTION =employee_homepage.php>";
echo"<Input type = 'Radio' Name ='operation' value= 'car_management'>manage a Car<br />";
echo"<Input type = 'Radio' Name ='operation' value= 'maintenance_request'>maintenance request <br />";
echo"<Input type = 'Radio' Name ='operation' value= 'change_rental_request'>change rental request<br />";
echo"<Input type = 'Radio' Name ='operation' value= 'view_reports'>view reports<br />";
echo"<select>";
echo"<option Name = 'operation2' value='location_preference_report'>Location Preference Reports</option>";
echo"<option Name = 'operation2' value='maintenance_preference'>Maintenance Preference Reports</option>";
echo"<option Name = 'operation2' value='frequent_user'>Frequent User Report</option>";
echo"<option Name = 'operation2' value='administrationm_request'>Administration Report</option>";
echo"</select><Input type = 'Submit' Name = 'Submit1' Value = 'Next'></FORM></div></body></html>";
        
?>



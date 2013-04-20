<?php
session_start();
$UserName = $_SESSION['UserName'];

?>


<html>
<body>

<?php
echo "The Current User is: ".$UserName;
?>

</body>
</html>
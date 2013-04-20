<?php

$connect = mysql_connect("localhost:3306", "root", "");
@mysql_select_db("Recipes") or die( "Unable to select database");

$NewRecipeName = $_POST['NewRecipeName'];
$NewRecipeRating = $_POST['NewRecipeRating'];

$insertStatement = "INSERT INTO Recipe (Name, Rating) VALUES ('$NewRecipeName', $NewRecipeRating)";
mysql_query($insertStatement);

?>

<html>
<body>
<h1>Recipe Added:  <?php echo $NewRecipeName ?></h1>
</body>
</html>
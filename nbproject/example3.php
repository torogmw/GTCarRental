<?php
$connect = mysql_connect("localhost:3306", "root", "");
@mysql_select_db("Recipes") or die( "Unable to select database");
?>

<html>
<body>
<h1>My Recipes</h1>

<!-- Create a table to display list of Recipes -->
<table>
<tr>
	<th>Recipe ID</th>
	<th>Recipe Name</th>
	<th>Recipe Rating</th>
</tr>


<?php
$query = "SELECT * FROM recipe";
$result = mysql_query($query);
$rowcount = mysql_numrows($result);

$i=0;
while ($i < $rowcount) {

	$RecipeID = mysql_result($result, $i, "RecipeID");
	$RecipeName = mysql_result($result, $i, "Name");
	$RecipeRating = mysql_result($result, $i, "Rating");
?>
	<tr>
		<td><?php echo $RecipeID; ?></td>
		<td><?php echo $RecipeName; ?></td>
		<td><?php echo $RecipeRating; ?></td>
	</tr>

<?php
	$i++;
}
?>

</table>

</body>
</html>
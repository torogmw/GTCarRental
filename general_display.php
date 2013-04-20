<!DOCTYPE HTML PUBLIC
               "-//W3C//DTD HTML 4.0 Transitional//EN"
               "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>Display Test</title>
</head>
<body>
<?php
  include 'dbinfo.php';

  // Show the wines in an HTML <table>
  function display($result)
  {

     echo "<h1>This is your information</h1>\n";

     // Start a table, with column headers
     echo "\n<table>\n<tr>\n" .
          "\n\t<th>Wine ID</th>" .
          "\n\t<th>Wine Name</th>" .
          "\n\t<th>Type</th>" .
          "\n\t<th>Year</th>" .
          "\n\t<th>Winery ID</th>" .
          "\n\t<th>Description</th>" .
          "\n</tr>";

     // Until there are no rows in the result set,
     // fetch a row into the $row array and ...
     while ($row = @ mysql_fetch_row($result))
     {
        // ... start a TABLE row ...
        echo "\n<tr>";

        // ... and print out each of the attributes
        // in that row as a separate TD (Table Data).
        foreach($row as $data)
           echo "\n\t<td> $data </td>";

        // Finish the row
        echo "\n</tr>";  
     }

     // Then, finish the table
     echo "\n</table>\n";
  }

  $query = "SELECT * FROM wine";

  // Connect to the MySQL server
  if (!($connection = @ mysql_connect($hostname,
                                      $username,
                                      $password)))
     die("Cannot connect");

  if (!(mysql_select_db("winestore", $connection)))
     showerror( );

  // Run the query on the connection
  if (!($result = @ mysql_query ($query, $connection)))
     showerror( );

  // Display the results
  displayWines($result);

  // Close the connection
  if (!(mysql_close($connection)))
     showerror( );
?>
</body>
</html>
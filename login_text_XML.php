<?php
include 'dbinfo.php';

$UserName = $_POST['UserName'];
$Password = $_POST['Password'];


#

$SQL_query = "SELECT * FROM member where UserName='$UserName'";


$DB_link = mysql_connect($host, $dbUserName, $dbPassword) or die("Could not connect to host.");
mysql_select_db($db, $DB_link) or die ("Could not find or access the database.");
$result = mysql_query ($SQL_query, $DB_link) or die ("Data not found. Your SQL query didn't work... ");

#echo $result;
// we produce XML
header("Content-type: text/xml");
$XML = "<?xml version=\"1.0\"?>\n";
if ($xslt_file) $XML .= "<?xml-stylesheet href=\"$xslt_file\" type=\"text/xsl\" ?>";
 
// root node
$XML .= "<result>\n";
// rows
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {    
  $XML .= "\t<row>\n"; 
  $i = 0;
  // cells
  foreach ($row as $cell) {
    // Escaping illegal characters - not tested actually ;)
    $cell = str_replace("&", "&amp;", $cell);
    $cell = str_replace("<", "&lt;", $cell);
    $cell = str_replace(">", "&gt;", $cell);
    $cell = str_replace("\"", "&quot;", $cell);
    $col_name = mysql_field_name($result,$i);
    // creates the "<tag>contents</tag>" representing the column
    $XML .= "\t\t<" . $col_name . ">" . $cell . "</" . $col_name . ">\n";
    $i++;
  }
  $XML .= "\t</row>\n"; 
 }
$XML .= "</result>\n";
 
// output the whole XML string
echo $XML;

 
?>

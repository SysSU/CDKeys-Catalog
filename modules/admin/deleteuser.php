<?php 
//Get variable passed on from link on other page
$id = $_GET['user'];

// SQL CONNECT
//mysql_connect($dbhost, $dbuser, $dbpass) or die("Error: ".mysqlerror());
mysql_select_db($dbname);



//replace TestTable with the name of your table
$sql = "DELETE FROM $table WHERE id='$id'";
mysql_query($sql) or die ("Error: ".mysql_error());

echo "Deleted <a href=\"index.php?pg=admin\">Return to Program</a>";
?>





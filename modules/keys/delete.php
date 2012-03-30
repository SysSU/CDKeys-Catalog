<?php 
//Get variable passed on from link on other page
$key = $_GET['key'];

// SQL CONNECT
//mysql_connect($dbhost, $dbuser, $dbpass) or die("Error: ".mysqlerror());
mysql_select_db($dbname);



//replace TestTable with the name of your table
$sql = "DELETE FROM $table WHERE id='".$key."'";
mysql_query($sql) or die ("Error: ".mysql_error());

echo $keydeleted;
?>




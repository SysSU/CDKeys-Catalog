<?php 
// UPDATED VERSION I WANT THE WHOLE SCRIPT TO RUN LIKE THIS

// Get variables from edit.php
$addusername = $_POST['username'];
$addpassword = $_POST['password'];
$addusergroup = $_POST['usergroup'];

// Make sure everything is set by checking if variables are NULL if so then show form
// If not then run SQL INSERT
if (!isset($addusername) OR !isset($addusergroup) OR !isset($addpassword)) {

$formblock = "<h2>Add User</h2> ";
$formblock .="<form action=\"index.php?pg=admin&view=adduser\" method=\"post\">";
$formblock .="<h3>ID</h3><input type=\"text\" value=\"AUTO SET\" name=\"id\" READONLY/>";
$formblock .="<h3>Username</h3></h3><input type=\"text\" value=\"\" name=\"username\" />";
$formblock .="<h3>Password</h3><input type=\"text\" value=\"\" name=\"password\" type=\"password\"/>";
$formblock .="<h3>Group</h3> ";
$formblock .="<select name=\"usergroup\"> ";
$formblock .="<option value=\"Admin\">Admin</option> ";
$formblock .="<option value=\"User\">User</option> ";
$formblock .="</select>";
$formblock .="<br><input name=\"Submit Changes\" type=\"submit\" value=\"Submit Changes\" />";
$formblock .="</form>";
echo $formblock;

}else{

// SELECT MYSQL DATABSE
mysql_select_db($dbname, $database);
//replace TestTable with the name of your table
$sql = "INSERT INTO $table (id, username, password, usergroup) VALUES ('NULL', '$addusername', '".sha1($addpassword)."','$addusergroup')";
mysql_query($sql) or die ("Error: ".mysql_error());
echo "<a href=\"index.php?pg=admin\">Return to Program</a>";

}


?>



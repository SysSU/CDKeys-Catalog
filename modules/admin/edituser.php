<?php 
// UPDATED VERSION I WANT THE WHOLE SCRIPT TO RUN LIKE THIS

// get url varialbe "Key" to display key by ID
$id = $_GET['user'];
// Get variables from edit.php
$username = $_POST['username'];
$password = $_POST['password'];
$usergroup = $_POST['usergroup'];

// Make sure everything is set by checking if variables are NULL if so then show form
// If not then run SQL INSERT
if (!isset($username) OR !isset($usergroup)) {



//connection to the database
$selected = mysql_select_db($dbname, $database) or die("Could not select Database");
	
//execute the SQL query and return records
$result = mysql_query("SELECT * FROM $table WHERE id='$id'") or die("Could not select User Info");

//fetch tha data from the database
$row = mysql_fetch_array( $result ) or die("Could not put in array"); 



$username = $row{'username'};
$usergroup = $row{'usergroup'};

$formblock = "<h2>Edit User Info</h2> ";
$formblock .="<form action=\"index.php?pg=admin&view=edituser\" method=\"post\">";
$formblock .="<h3>ID</h3><input type=\"text\" value=\"$id\" name=\"id\" READONLY/>";
$formblock .="<h3>Username</h3></h3><input type=\"text\" value=\"$username\" name=\"username\" />";
$formblock .="<h3>Password (Leave blank to not change)</h3><input type=\"text\" value=\"\" name=\"password\" type=\"password\"/>";
$formblock .="<h3>Group</h3> ";
$formblock .="<select name=\"usergroup\"> ";
$formblock .="<option value=\"Admin\">$usergroup</option> ";
$formblock .="<option value=\"Admin\">Admin</option> ";
$formblock .="<option value=\"User\">User</option> ";
$formblock .="</select>";
$formblock .="<br><input name=\"Submit Changes\" type=\"submit\" value=\"Submit Changes\" />";
$formblock .="</form>";
echo $formblock;

}else{

$id = $_POST['id'];



// SELECT MYSQL DATABSE
mysql_select_db($dbname, $database);



if (isset($password)) {
$sql = "UPDATE `$table` SET  `username` = '$username',`usergroup` = '$usergroup',`password` = '".sha1($password)."' WHERE `$table`.`ID` = '$id' LIMIT 1";
mysql_query($sql) or die ("Error: ".mysql_error());


echo "<a href=\"index.php?pg=admin\">Return to Program</a>";

}else {



$sql = "UPDATE `$table` SET  `username` = '$username',`usergroup` = '$usergroup' WHERE `$table`.`ID` = '$id' LIMIT 1";
mysql_query($sql) or die ("Error: ".mysql_error());


echo "<a href=\"index.php?pg=admin\">Return to Program</a>";

}
}


?>




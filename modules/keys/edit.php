<?php 
// Get variables from edit.php
$id = $_POST['id'];
$program = $_POST['program'];
$key = $_POST['key'];
$notes = $_POST['notes'];
$category = $_POST['category'];

if (!isset($key) OR !isset($program) OR $key == "" OR $program == "") {
// get url varialbe "Key" to display key by ID
$key = $_GET['key'];
//connection to the database
$selected = mysql_select_db($dbname, $database) or die("Could not select Keys Database");
$sql = "SELECT * FROM $table WHERE id=$key";
//execute the SQL query and return records
$result = mysql_query($sql);
//fetch tha data from the database
$row = mysql_fetch_array( $result ); 
	
$htmlblock = "<div class=\"key_input_fields\">";
$htmlblock .= "<h2>Edit Key Info</h2> ";
$htmlblock .= "<form action=\"index.php?pg=keys&view=edit\" method=\"post\">";
$htmlblock .= "<div class=\"id\"><h3>ID</h3><input type=\"text\" value=\"".$row{'id'}."\" name=\"id\" READONLY/></div>";
$htmlblock .= "<div class=\"program\"><h3>Program Name</h3><input type=\"text\" value=\"".$row{'program'}."\" name=\"program\" /></div>";
$htmlblock .= "<div class=\"key\"><h3>Key</h3><input type=\"text\" value=\"".$row{'program_key'}."\" name=\"key\" /></div>";
$htmlblock .= "<div class=\"category\"><h3>Category</h3> ";
$htmlblock .= "<select name=\"category\"> ";
$htmlblock .= "<option value=\"".$row{'category'}."\">".$row{'category'}."</option>";
$htmlblock .= "<option value=\"Other\">Other</option> ";
$htmlblock .= "<option value=\"Applications\">Applications</option>"; 
$htmlblock .= "<option value=\"OS\">OS</option>";
$htmlblock .= "<option value=\"Games\">Games</option>";
$htmlblock .= "</select></div>";
$htmlblock .= "<div class=\"notes\"><h3>Notes</h3>";
$htmlblock .= "<p>Enter some notes about the program</p>";
$htmlblock .= "<textarea   name=\"notes\">".$row{'program_notes'}."</textarea><br></div>";
$htmlblock .= "<input name=\"Submit Changes\" type=\"submit\" value=\"Submit Changes\" />";
$htmlblock .= "</form></div>";
$htmlblock .= "<a href=\"index.php?pg=keys&view=delete&key=".$row{'id'}."\" style=\"color:red;\">DELETE KEY</a>";
echo $htmlblock;

}else{

// SELECT MYSQL DATABSE
$connect = "mysql_select_db($dbname, $database)";

// set variable called $sql to set mysql query to "UPDATE" a key
$sql = "UPDATE `$table` SET  `category` = '$category',`program` = '$program',`program_key` = '$key',`program_notes` = '$notes' WHERE `$table`.`ID` = '$id' LIMIT 1";

// updates key from $sql or errors out
echo $connect;
mysql_query($sql) or die ("Error: Unable QUERY");
// echo that its completed
// $keyedit called from includes/config.php
echo "$keyedited <a href=\"index.php?pg=keys&view=single&key=$id\">Return to Program</a>";

}

?>
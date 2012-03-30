<?php 

// Get variables from edit.php
$program = $_POST['program'];
$key = $_POST['key'];
$notes = $_POST['notes'];
$category = $_POST['category'];


if (!isset($key) OR !isset($program) OR $key == "" OR $program == "") {
	
$htmlblock = "<div class=\"key_input_fields\">";
$htmlblock .= "<h2>Add Key</h2> ";
$htmlblock .= "<form action=\"index.php?pg=keys&view=add\" method=\"post\">";
$htmlblock .= "<div class=\"id\"><h3>ID</h3><input type=\"text\" value=\"AUTO GENERATED\" name=\"id\" READONLY/></div>";
$htmlblock .= "<div class=\"program\"><h3>Program Name</h3><input type=\"text\" value=\"\" name=\"program\" /></div>";
$htmlblock .= "<div class=\"key\"><h3>Key</h3><input type=\"text\" value=\"\" name=\"key\" /></div>";
$htmlblock .= "<div class=\"category\"><h3>Category</h3> ";
$htmlblock .= "<select name=\"category\"> ";
$htmlblock .= "<option value=\"Other\">Other</option> ";
$htmlblock .= "<option value=\"Applications\">Applications</option>"; 
$htmlblock .= "<option value=\"OS\">OS</option>";
$htmlblock .= "<option value=\"Games\">Games</option>";
$htmlblock .= "</select></div>";
$htmlblock .= "<div class=\"notes\"><h3>Notes</h3>";
$htmlblock .= "<p>Enter some notes about the program</p>";
$htmlblock .= "<textarea   name=\"notes\"></textarea><br></div>";
$htmlblock .= "<input name=\"Submit Changes\" type=\"submit\" value=\"Add Key\" />";
$htmlblock .= "</form></div>";
echo $htmlblock;

}else{

mysql_select_db("$dbname", $database) or die ("Could not select DB");
//set variable sql to add new key
$sql = "INSERT INTO $table (id, program, program_key, program_notes, category) VALUES (NULL, '$program', '$key', '$notes', '$category')" or die ("Could not add");


mysql_query($sql) or die ("Error: Unable QUERY");
// called from includes/config.php lets user know its been added
echo $keyadded;

}

?>



<?php
// Get action variable from URL
if (isset($_POST['action'])){
$action = $_POST['action'];
} else {
$action = $_GET['action'];
}


// Check to see if action not set or set 1 one
if (!isset($action) OR $action == "1"){

// Connect to SQL
$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);





$htmlblock = "";
$htmlblock .="<h2>Please Select the action you want to preform</h2>";
$htmlblock .="<p>- If you select <strong>Create Table</strong> you MUST fill in the \"Table Name\" field.<br>
- If you select <strong>Edit Table</strong> you will be able to edit the selected tables  fields.<br>
- If you select <strong>View Table</strong> you will be able to view the selected tables.<br>
- If you select <strong>Delete Table</strong> this will DELETE the selected table and you will not be able to recover it.</p><br><br>";
$htmlblock .="<center>";
$htmlblock .="<form Method=\"POST\" Action=\"index.php?pg=admin&view=createdatabase\">";
$htmlblock .="Select Action: <select name=\"action\">";
$htmlblock .="<option value=\"2\">Create Table</option>";
$htmlblock .="<option value=\"3\">View Table</option>";
$htmlblock .="<option value=\"4\">Edit Table</option>";
$htmlblock .="<option value=\"5\">Delete Table</option>";
$htmlblock .="</select><br>";
$htmlblock .="Select Table (If Exists): <select name=\"table\">";
$htmlblock .="<option value=\"1\"></option>";
// Display all tables in database
while ($row = mysql_fetch_row($result)) {
$htmlblock .="<option value=\"$row[0]\">$row[0]</option>";
}
$htmlblock .="</select><br>";
$htmlblock .="Table Name (If New): <input value=\"\" type=\"txt\" name=\"create_table_name\" ><br>";
$htmlblock .="<input value=\"Perform\" type=\"Submit\" >";
$htmlblock .="</form>";
$htmlblock .="</center><br><br>";
echo $htmlblock;




}




 
?>
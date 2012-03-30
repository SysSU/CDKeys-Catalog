<?php
// Get action variable from URL
if (isset($_POST['action'])){
$action = $_POST['action'];
} else {
$action = $_GET['action'];
}

///////////////////////////////////////
//////////VIEW FIRST MENU//////////////
///////////////////////////////////////
// Check to see if action not set or set 1 one
if (!isset($action) OR $action == "1"){

// Connect to SQL
$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql) or die ("Was not able to query");
$htmlblock = "";
$htmlblock .="<h2>Please Select the action you want to preform</h2>";
$htmlblock .="<p>- If you select <strong>Create Table</strong> you MUST fill in the \"Table Name\" field.<br>
- If you select <strong>View Table</strong> you will be able to view the selected tables.<br>
<span style=\"color:red; \">- If you select <strong>Delete Table</strong> this will PERMANENTLY DELETE the selected table.</span></p><br><br>";
$htmlblock .="<center>";
$htmlblock .="<form Method=\"POST\" Action=\"index.php?pg=admin&view=database\">";
$htmlblock .="Select Action: <select name=\"action\">";
$htmlblock .="<option value=\"2\">View Table</option>";
$htmlblock .="<option value=\"3\">Create Table</option>";
$htmlblock .="<option value=\"4\" >Drop/Delete Table</option>";
$htmlblock .="</select><br>";
$htmlblock .="Select Table (If Exists): <select name=\"table\">";
$htmlblock .="<option value=\"1\"></option>";
// Display all tables in database
while ($row = mysql_fetch_row($result)) {
$htmlblock .="<option value=\"$row[0]\">$row[0]</option>";
}
$htmlblock .="</select><br>";
$htmlblock .="Table Name (If New): <input value=\"\" type=\"text\" name=\"create_table_name\" ><br>";
$htmlblock .="<input value=\"Perform\" type=\"Submit\" >";
$htmlblock .="</form>";
$htmlblock .="</center><br><br>";
echo $htmlblock;

///////////////////////////////////////
//////////VUEW TABLE PART//////////////
///////////////////////////////////////
} else if ($action == "2") {

// Connect my SQL
$table = $_POST['table'];
// Select database to connect to
mysql_select_db($dbname) or die ("Can't select database");
// sending query to sql
$sql ="SELECT * FROM $table";
$result = mysql_query($sql) or die("Query to show fields from table failed");
// print out table name
$htmlblock = "<h2>Table: $table</h2>";
$htmlblock .= "<ul>";
// print out table row names
while ($field = mysql_fetch_field($result)) {
$htmlblock .="<li>$field->name</li>";
}
$htmlblock .= "</ul>\n";
$htmlblock .="<a href=\"index.php?pg=admin&view=database\">Go Back</a>";
// echo html block like always
echo $htmlblock;

///////////////////////////////////////
//////////CREATE TABLE PART////////////
///////////////////////////////////////
} else if ($action == "3") {
// Set some variables used on step 3 creating table
$create_table_name = $_POST['create_table_name'];
$step = $_POST['step'];

// Check to make sure they inputed something for the table name
if (!isset($create_table_name) OR $create_table_name == ""){

echo "Sorry you forgot to enter a table name please go back.";

// this is step one where you input number of fields you want to populate table with
} else if (isset($create_table_name) && !isset($step)){

$htmlblock ="<h2>How many fields for: $create_table_name</h2>";
$htmlblock .="<form Method=\"POST\" Action=\"index.php?pg=admin&view=database\">";
$htmlblock .="Number of fields: <input value=\"\" type=\"text\" name=\"numfields\" ><br>";
$htmlblock .="<input value=\"2\" type=\"hidden\" name=\"step\" >";
$htmlblock .="<input value=\"3\" type=\"hidden\" name=\"action\" >";
$htmlblock .="<input value=\"$create_table_name\" type=\"hidden\" name=\"create_table_name\" >";
$htmlblock .="<input value=\"Perform\" type=\"Submit\" >";
$htmlblock .="</form>";
echo $htmlblock;

// step 2 this is where it populates html with fields to be set
} else if (isset($create_table_name) && $step == "2") {

$numfields = $_POST['numfields'];
$htmlblock ="<h2>Field Creation for: $create_table_name</h2>";
$htmlblock .="<form Method=\"POST\" Action=\"index.php?pg=admin&view=database\">";
$htmlblock .="<table cellspacing=5 cellpadding=5>";
$htmlblock .="<tr>";
$htmlblock .="<th><strong>Field Name</strong></th><th><strong>Field Type</strong></th><th><strong>Field Length</strong></th><th><strong>Primary Key?</strong></th><th><strong>Auto-Inc?</strong></th>";
$htmlblock .="</tr>";
// Count from 0 until you reach the number of fields
// for to display correct amount of fields
for ($i = 0; $i <$numfields; $i++) {

$htmlblock .="<tr>";
$htmlblock .="<td align=center><input type =\"text\" name=\"field_name[]\" size=\"30\"></td>";
$htmlblock .="<td align=center>";
$htmlblock .="<select name=\"field_type[]\">";
$htmlblock .="<option value=\"char\">char</option>";
$htmlblock .="<option value=\"date\">date</option>";
$htmlblock .="<option value=\"float\">float</option>";
$htmlblock .="<option value=\"int\">int</option>";
$htmlblock .="<option value=\"text\">text</option>";
$htmlblock .="<option value=\"varchar\">varchar</option>";
$htmlblock .="</select>";
$htmlblock .="</td>";
$htmlblock .="<td align=center><input type=\"text\" name=\"field_length[]\" size=\"5\"></td>";
$htmlblock .="<td align=center><input type=\"checkbox\" name=\"primary[]\" value=\"Y\"></td>";
$htmlblock .="<td align=center><input type=\"checkbox\" name=\"auto_increment[]\" value=\"Y\"></td>";

}
// stuff to send with form to know to go to next step in same action
$htmlblock .="<input value=\"3\" type=\"hidden\" name=\"step\" >";
$htmlblock .="<input value=\"3\" type=\"hidden\" name=\"action\" >";
$htmlblock .="<input value=\"$create_table_name\" type=\"hidden\" name=\"create_table_name\" >";

// end HTML for field input script
$htmlblock .="<tr><td align=center colspan=3><input value=\"Create Table\" type=\"Submit\" ></td></tr>";
$htmlblock .="</tr>";
$htmlblock .="</table>";
$htmlblock .="</form>";
// echo html block to display HTML stuff
echo $htmlblock;
// step 3 this is where it creates the table
} else if (isset($create_table_name) && $step == "3") {
// slect the database to create table for
mysql_select_db($dbname, $database) or die ("Can't select database");
// string to create table
$sql = "CREATE TABLE $create_table_name (";


// create rest of sql statment for each field
// auto increment 
for ($i = 0; $i < count($_POST[field_name]); $i++){
// add to sql post name and field

$sql .= $_POST[field_name][$i]." ".$_POST[field_type][$i];
// if auto inc was set then add to additional
if ($_POST[auto_increment][$i] == "Y"){
$additional = "NOT NULL auto_increment";
} else {
$additional = "";
}
// if pirmary selected then add to additional
if ($_POST[primary][$i] == "Y"){
$additional .= ", primary key (".$_POST[field_name][$i].")";
} else {
$additional .= "";
}
// if field lengh is not blank then add the field lengh to sql else dont
if ($_POST[field_length][$i] != ""){
$sql .= " (".$_POST[field_length][$i].") $additional ,";
} else {
$sql .= " $additional ,";
}
}
// clean up the end of the string
$sql = substr($sql, 0, -1);
$sql .= ")";

// execute query

$result = mysql_query($sql) or die ("UNABLE TO QUERY");
// display if success
if ($result){
echo "Table called '$create_table_name' created with the fields <a href=\"index.php?pg=admin&view=database\">Back to admin</a>";
}
}

///////////////////////////////////////
////////////DROP TABLE PART////////////
///////////////////////////////////////
} else if ($action == "4") {
// grab post table name from post
$table = $_POST['table'];
// select database
mysql_select_db($dbname, $database) or die ("Can't select database");
// string for query below
$sql ="DROP TABLE $table";
// query string above or die
$result = mysql_query($sql) or die("Query to show fields from table failed");
// display if success
if ($result){
echo "Table called '$table' DELETED/DROPED <a href=\"index.php?pg=admin&view=database\">Back to database admin</a>";
}
}





?>
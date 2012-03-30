<?php 

// Title and text changeable in config.php
echo "<h2> $viewalluserstitleadmin </h2>";
echo "<p> $viewalluserstextadmin </p>";


////////////////////////////////////////////////
///////////connection to the database///////////
/////////////////////////////////////////////////
$selected = mysql_select_db($dbname, $database) or die("Could not select Keys Database");	
// Query used below by $result variable and $numresults variable
$query = "SELECT * FROM $table";


////////////////////////////////////////////////
///////////Start page counter stuff/////////////
////////////////////////////////////////////////
// Rows to return per page used below in $query to set limits
$limit=10; 
// Get page counter Used below 
$s = @$_GET['s'];
//determine if s has been passed to script, if not use 0
if (empty($s)) {
$s=0;
}
$count = 1 + $s ;
$numresults=mysql_query($query);
$numrows=mysql_num_rows($numresults);


///////////////////////////////////////////////
/////////////get results and output/////////////
////////////////////////////////////////////////
$query .= " limit $s,$limit";
$result = mysql_query($query) or die("Couldn't execute query");
echo "<ul class=\"body_menu\">";
//Open up an array and for each row...
while ($row = mysql_fetch_array($result)) {
// Create LI for each row in DB not exeeding limit set in above $query.
echo "<li> <a href=\"index.php?pg=admin&view=singleuser&user=".$row{'id'}."\">".$row{'username'}."</a></li>";
// Add to counter
$count++ ;			
} 
// Close DIV tag from above and close UL from unordered list above.
echo "</ul>";


//////////////////////////////////////////////////
////////////PAGE COUNTER OUTPUT//////////////////
////////////////////////////////////////////////
$currPage = (($s/$limit) + 1);
//Bbreak before paging
 echo "<br />";
// Next we need to do the links to other results
if ($s>=1) { // bypass PREV link if s is 0
$prevs=($s-$limit);
// Echo out prev link if $s is greater than 1 or not not displaying first page
echo "&nbsp;<a href=\"index.php?pg=admin&s=$prevs\">&lt;&lt; Prev 10</a>&nbsp&nbsp;";
}
// Calculate number of pages needing links
$pages=intval($numrows/$limit);
// $pages now contains int of pages needed unless there is a remainder from division
if ($numrows%$limit) {
// has remainder so add one page
$pages++;
}
// Check to see if not last page or ONLY page
if (!((($s+$limit)/$limit)==$pages) && $pages!=1) {
// Sets correct $next variable for using s for above to set correct link for next page
$next=$s+$limit;
// Echo next page if it is NOT the last page
echo "&nbsp;<a href=\"index.php?pg=admin&s=$next\">Next 10 &gt;&gt;</a>";
}


//////////////////////////////////////////////////
////////////Showing Results Output////////////////
/////////////////////////////////////////////////
// Displays what you are showing to 
// by taking $s (what you started on) plus $limit (what it goes to) and adding them together
$a = $s + ($limit);
// If $a exceeds the number of rows in the table then set $a to how many rows are in tables from $numrows
if ($a > $numrows) { $a = $numrows ; }
// $b is where your results started from and is added by taking $s (where to start) plus 1 because limit from sql
// always displays the one AFTER the number for ex. if $s was 5 it would start on 6
$b = $s + 1 ;
// Echo showing results
echo "<p>Showing results $b to $a of $numrows</p>";
// echo admin menu from modules/admin.php
echo $adminmenu;
?>
		

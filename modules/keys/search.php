<?php
// Show search from from index.php
echo $searchform;
// Original script from http://www.designplace.org/scripts.php?page=1&c_id=25
// Get the search variable from URL
// used by search form for search and next/prev page URL
$searchvar = @$_POST['q'];
// Used by URL Variable for search and next/prev page URL
$searchvar .= @$_GET['q'];
// Used by next/prev URL
$s = @$_GET['s'];
// Take searchvar and trim it up by getting rid of white spaces
$trimmedsearch = trim($searchvar);
// Number of rows/results to display per page
$limit=10; 
// Check to see if after trim there is nothing set if not display error message and quit
if ($trimmedsearch == "")
{
echo "<p>Please enter a search...</p>";
echo $footer;
exit;
}

// Check to see if $searchvar has a value if not display error message and quit
if (!isset($searchvar))
{
echo "<p>We dont seem to have a search parameter!</p>";
echo $footer;
exit;
}

//connect to database
mysql_connect("$dbhost","$dbuser","$dbpass"); 

//specify database ** EDIT REQUIRED HERE **
mysql_select_db("$dbname") or die("Unable to select database"); //select which database we're using

// Build SQL Query  
$query = "select * from cd_keys where program like \"%$trimmedsearch%\"  
order by program"; // EDIT HERE and specify your table and field names for the SQL query

$numresults=mysql_query($query);
$numrows=mysql_num_rows($numresults);

// If we have no results, offer a google search as an alternative

if ($numrows == 0)
{
echo "<h4>Results</h4>";
echo "<p>$searchfail</p>";

}

// next determine if s has been passed to script, if not use 0
if (empty($s)) {
$s=0;
}

// get results
$query .= " limit $s,$limit";
$result = mysql_query($query) or die("Couldn't execute query");


///////////////////////////////////////////////
/////////////get results and output/////////////
////////////////////////////////////////////////
// PRETTY MUCH SAME AS KEYS HOME
// display what the person searched for
echo "<p><strong>Searched for</strong>: $searchvar<br>";
echo "$searchsuccess</p>";


// start to display results
$count = 1 + $s ;

// now you can display the results returned
echo "<br>";
  while ($row= mysql_fetch_array($result)) {
  $title = $row["program"];
  $id = $row["id"];

  echo "$count.)&nbsp;<a href=\"?pg=keys&view=single&key=$id\">$title</a><br>\n" ;
  $count++ ;
  }

$currPage = (($s/$limit) + 1);

//break before paging
  echo "<br />";


//////////////////////////////////////////////////
////////////PAGE COUNTER OUTPUT//////////////////
////////////////////////////////////////////////
// SAME AS KEYS HOME PAGE
  // next we need to do the links to other results
if ($s>=1) { // bypass PREV link if s is 0
$prevs=($s-$limit);
print "&nbsp;<a href=\"index.php?pg=keys&view=search&s=$prevs&q=$searchvar\">&lt;&lt; 
Prev 10</a>&nbsp&nbsp;";
}
// calculate number of pages needing links
$pages=intval($numrows/$limit);
// $pages now contains int of pages needed unless there is a remainder from division
if ($numrows%$limit) {
// has remainder so add one page
$pages++;
}

// check to see if last page
if (!((($s+$limit)/$limit)==$pages) && $pages!=1) {

// not last page so give NEXT link
$next=$s+$limit;
// Echo search results
echo "&nbsp;<a href=\"index.php?pg=keys&view=search&s=$next&q=$searchvar\">Next 10 &gt;&gt;</a>";
}


//////////////////////////////////////////////////
////////////Showing Results Output////////////////
/////////////////////////////////////////////////
// SAME AS HOME PAGE
$a = $s + ($limit) ;
if ($a > $numrows) { $a = $numrows ; }
$b = $s + 1 ;
echo "<p>Showing results $b to $a of $numrows</p>";
  

?>
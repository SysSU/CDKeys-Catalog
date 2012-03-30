
<?php 
// get url varialbe "Key" to display key by ID
$key = $_GET['key'];
//connection to the database
$selected = mysql_select_db($dbname, $database) or die("Could not select Keys Database");
//execute the SQL query and return records
$result = mysql_query("SELECT * FROM cd_keys WHERE id='$key'");
//fetch tha data from the database
$row = mysql_fetch_array( $result ); 
 

  /*
  ***EXTRA CODE DOES NOTHING JUST TO HELP ME REMEMBER SOME STUFF

  while ($row = mysql_fetch_array($result)) {
  echo "ID:".$row{'id'}." Name:".$row{'program'}."Key: ".$row{'program_key'}."<br>";
  echo "<ul>\n";
  echo "<li id='id'>".$row{'id'}."</li>\n";
  echo "<li id='name'>".$row{'program'}."</li>\n";
  echo "<li id='key'>".$row{'program_key'}."</li>\n";
  echo "</ul>\n";
  
  */
  
  
  
  
  // BELOW PRINTS OUT ALL THE KEY INFO
 ?>


<ul>
<h3 class="program">Program:</h3>
<p><?php print $row{'program'};?></p>
<h3 class="program">Key:</h3>
<p><?php print $row{'program_key'};?></p>
<h3 class="category">Category:</h3>
<p> <?php print $row{'category'};?></p>
<h3 class="notes">Notes: </h3>
<p><?php print $row{'program_notes'};?></p>
</ul>

<div class="sub-menu">
<ul>
<li><a href="index.php?pg=keys&view=edit&key=<?php echo $row{'id'};?>" >Edit Key</a></li>
<li><a href="index.php?pg=keys&view=delete&key=<?php echo $row{'id'};?>" >Delete Key</a></li>
</ul>
</div>
<div class="clear"></div>

	

	





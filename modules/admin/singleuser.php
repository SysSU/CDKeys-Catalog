<?php 
// get url varialbe "Key" to display key by ID
$id = $_GET['user'];
//connection to the database
$selected = mysql_select_db($dbname, $database) or die("Could not select Keys Database");
//execute the SQL query and return records
$result = mysql_query("SELECT * FROM $table WHERE id='$id'");
//fetch tha data from the database
$row = mysql_fetch_array( $result ); 
 


  
 ?>


<ul>
<h3 class="program">UserName:</h3>
<p><?php print $row{'username'};?></p>
<h3 class="program">UserGroup:</h3>
<p><?php print $row{'usergroup'};?></p>

</ul>

<div class="sub-menu">
<ul>
<li><a href="index.php?pg=admin&view=edituser&user=<?php echo $row{'id'};?>" >Edit User</a></li>
<li><a href="index.php?pg=admin&view=deleteuser&user=<?php echo $row{'id'};?>" >Delete User</a></li>
</ul>
</div>
<div class="clear"></div>
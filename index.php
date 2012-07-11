<?php
// DO NOT CHANGE THIS LINE!
@include ('includes/config.php');



////////////////////////////////////
///////////Start Header////////////
////////////////////////////////////
$header = "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta content='index,follow' name='robots' />
<meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
<link href='css/style.css' rel='stylesheet' media='screen' type='text/css' />
<title>$sitetitle</title>
<!-- START TinyMCE Header Setup START -->
<!-- Applies to all text areas -->
<script type='text/javascript' src='jscripts/tiny_mce/tiny_mce.js'></script>
<script type='text/javascript'>
tinyMCE.init({ mode : 'textareas', cleanup : 'true',});
</script>
<!-- END TinyMCE Header Setup END -->
<!-- START Google jQuery START -->
<script type='text/javascript' src='/js/jQuery.min.js'></script>
<!-- END Google jQuery END -->
</head>
<body>";


////////////////////////////////////
////////Start HTML HEADER///////////
////////////////////////////////////
$htmlheader = "";



////////////////////////////////////
////////Start Search Form///////////
////////////////////////////////////
$searchform = "
<h3>$searchformtitle</h3>
<p>$searchformtext</p>
<form name='form' action='?pg=keys&view=search' method='post'>
<input type='text' name='q' />
<input type='submit' name='Submit' value='Search' />
</form>";


////////////////////////////////////
//////////Start footer/////////////
////////////////////////////////////
$footer = "
</div>
<div class='footer'>
<div class='logout'><a href='logout.php'>LOGOUT!</a></div>
<div class='powered-by'><a href='$poweredbylink'>$poweredby</a> <div> 
<div class='version'>Verson: Beta</div>

</div>\n</div>\n</div>\n<br><Br></body>\n</html>";


////////////////////////////////////
/////////Start access script////////
////////////////////////////////////
/* 
Usersname stored in users database. 
*/

// Start or resume session
session_start();
// If $_session LoggedIN is not set then set it to false or not loggedin 
if (!isset($_SESSION['loggedIn'])) {
// Sets session loggedIn to false
$_SESSION['loggedIn'] = false;
}
// If there is a $_POST with password variale run
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['login-form'])) {
// Select correct database
$selected = mysql_select_db($dbname, $database) or die("Could not select Keys Database");

	
// Query to be used below for mysql_fetch_array and mysql_num_rows
$query = mysql_query("SELECT * FROM users 
WHERE password = '".sha1($_POST['password'])."' 
AND username = '".$_POST['username']."'");
// Set variable that fetches number of rows from $query
$num = mysql_num_rows($query);
// If it finds at least one result then if statment is true 
if ($num != 0){
// Fetches results from $query and puts them in array called row
$row = mysql_fetch_array($query);
// Set sessions for username usergroup and set them as loggedIn to true.
$_SESSION['usergroup'] = $row{'usergroup'};
$_SESSION['username'] = $row{'username'};
$_SESSION['loggedIn'] = true;
// Else if none found display that htey were not able to be logged in.
} else {
die ("Incorrect password/Username<br><Br> <a href='index.php'>Go back!</a>".$_POST['username']."");
}

}


// If session is not set to loggedIN then show login box
if (!$_SESSION['loggedIn']) {



// Start output for login box
$loginbox = $header;
$loginbox .= "
<div id='login-box'>
<H2>Login</H2>
$pleaselogin 
<br />
<br />
<form method='post'>
<div id='login-box-name'>UserName:</div><div id='login-box-field'><input name='username'  class='form-login' title='username' value='' size='30' maxlength='2048' type='text' /></div>
<div id='login-box-name'>Password:</div><div id='login-box-field'><input name='password' type='password' class='form-login' title='Password' value='' size='30' maxlength='2048' /></div>
<input name='login-form' type='hidden'  title='login-form' value='1'  />
<br />
<span class='login-box-options'> <a href='#' style='margin-left:30px;'>Forgot password?</a></span>
<br />
<br />
<input id='login-box-submit' type='submit' value='LOGIN'>
</div>
</form>";
// Output $loginbox variable
echo $loginbox;
// Exit PHP
exit();
}


// Variables set by login and to be used throughout the script
$usergroup = $_SESSION['usergroup'];
$username = $_SESSION['username'];


////////////////////////////////////
///////////Start Menu///////////////
////////////////////////////////////
$menu = "
<div class=\"menu\">
<ul>
<li><a href=\"index.php\">Home</a></li>
<li><a href=\"?pg=keys\">View All Keys</a></li>
<li><a href=\"?pg=keys&view=search\">Search Keys</a></li>
<li><a href=\"?pg=keys&view=add\">Add Key</a></li>\n";
// add admin link if loged in as admin
if (preg_match("/Admin/i", "$usergroup")){
$menu .= "<li class=\"admin\"><a href=\"?pg=admin\">Admin</a></li>\n";
}
$menu .= "<li class=\"log-out\"><a href=\"logout.php\">LogOut</a></li>
<li class=\"welcome\">Hello $username</li>
</ul>
</div>
<div class=\"clear\"></div>";


////////////////////////////////////
////////Start Content Area//////////
////////////////////////////////////
/* 
Reason I used moduels is this way you can easily add new features or modules 
to the script just by droppingthem in the modules folder and calling on them 
with the  correct URL. For example I can create a passwords module
*/


// Echo header for when not at login page
echo $header;
// Start of container. Ended in incluedes/footer.php
echo "<div class=\"container\">";
echo "<div class=\"page\">";
// echo html header from above
echo $htmlheader;
// Echo menu from above
echo $menu;
echo "<div class=\"content\">";
// Include page based on pg variable in URL or display home.php
if(isset($_GET['pg'])&&$_GET['pg']!=""){
// Grab pg variable from URL with $_GET and set it as $pg variable	
$pg = $_GET['pg'];
// If the pg variable is set to a page that exist in modules with .php extention 
// Then include that page
if(file_exists('modules/'.$pg.'.php')){
include ('modules/'.$pg.'.php');
// Else if a variable is set and it does not exist then dispaly no such file
}elseif(!file_exists('modules/'.$pg.'.php')){	
echo 'No such page';
}
// Else if not set then display home.php from modules dir.
} else {	
include ('modules/home.php');
}




// Echo footer for output of data above
echo $footer;
// Close SQL Connection because it is no longer needed after page is all loaded
mysql_close();
?>
	


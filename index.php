<?php
//////////////////START////////////////////
//DO NOT MIDIFY ANYTHING BELOW THIS POINT//
/////////////////START////////////////////
@include ('includes/config.php');

$database = mysql_connect($dbhost, $dbuser, $dbpass) or trigger_error(mysql_error(),E_USER_ERROR); 
/////////////////END///////////////////////
//////IT IS OK TO START EDITING AGAIN /////
////////////////END///////////////////////

////////////////////////////////////
///////////Start Header////////////
////////////////////////////////////
$header = "";
$header .= "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
$header .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
$header .= "<head>\n";
$header .= "<meta content=\"index,follow\" name=\"robots\" />\n";
$header .= "<meta content=\"text/html; charset=utf-8\" http-equiv=\"Content-Type\" />\n";
$header .= "<link href=\"css/style.css\" rel=\"stylesheet\" media=\"screen\" type=\"text/css\" />\n";
$header .= "<title>$sitetitle</title>\n";
// START TINYMCE HEADER SETUP 
// Applies to all text areas
$header .= "<script type=\"text/javascript\" src=\"jscripts/tiny_mce/tiny_mce.js\"></script>\n";
$header .= "<script type=\"text/javascript\">\n";
$header .= "tinyMCE.init({\n";
$header .= "	mode : \"textareas\",\n";
$header .= "cleanup : \"true\",\n";
$header .= "});\n";
$header .= "</script>\n";
// END OF TINMCE HEADER SETUP
$header .= "</head>\n";
$header .= "<body>\n";


////////////////////////////////////
////////Start HTML HEADER///////////
////////////////////////////////////
$htmlheader = "";



////////////////////////////////////
////////Start Search Form///////////
////////////////////////////////////
$searchform = "";
$searchform .= "<h3>$searchformtitle</h3>\n";
$searchform .= "<p>$searchformtext</p>\n";
$searchform .= "<form name=\"form\" action=\"?pg=keys&view=search\" method=\"post\">\n";
$searchform .= "<input type=\"text\" name=\"q\" />\n";
$searchform .= "<input type=\"submit\" name=\"Submit\" value=\"Search\" />\n";
$searchform .= "</form>\n";


////////////////////////////////////
//////////Start footer/////////////
////////////////////////////////////
$footer = "";
// Closing tag for content
$footer .= "</div>\n";
// Open footer div
$footer .= "<div class=\"footer\">\n";
// Include logout link that goes to logout.php to logout
$footer .= "<div class=\"logout\"><a href=\"logout.php\">LOGOUT!</a></div>\n";
// Powerd by link that variables can be found in config.php
$footer .= "<div class=\"powered-by\"><a href=\"$poweredbylink\">$poweredby</a> <div> \n";
// version variable can be found in config.php
$footer .= "<div class=\"version\">Verson: Beta</div>\n";
// Close all HTML tags
$footer .= "</div>\n</div>\n</div>\n<br><Br></body>\n</html>";


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
$loginbox = "";
// Add header to login box
$loginbox .= $header;
// Stat div box for login
$loginbox .= "<div id=\"login-box\">\n";
// Login box header
$loginbox .= "<H2>Login</H2>";
// Login box text found in config.php
$loginbox .= "$pleaselogin\n"; 
$loginbox .= "<br />";
$loginbox .= "<br />";
// HTML form for login
$loginbox .= "<form method=\"post\">\n";
// Field for login
$loginbox .= "<div id=\"login-box-name\">UserName:</div><div id=\"login-box-field\"><input name=\"username\"  class=\"form-login\" title=\"username\" value=\"\" size=\"30\" maxlength=\"2048\" type=\"text\" /></div>\n";
$loginbox .= "<div id=\"login-box-name\">Password:</div><div id=\"login-box-field\"><input name=\"password\" type=\"password\" class=\"form-login\" title=\"Password\" value=\"\" size=\"30\" maxlength=\"2048\" /></div>\n";
$loginbox .= "<input name=\"login-form\" type=\"hidden\"  title=\"login-form\" value=\"1\"  />\n";
$loginbox .= "<br />";
// Forgot password link, not used yet
$loginbox .= "<span class=\"login-box-options\"> <a href=\"#\" style=\"margin-left:30px;\">Forgot password?</a></span>\n";
$loginbox .= "<br />";
$loginbox .= "<br />";
// Submit button for login form
$loginbox .= "<input id=\"login-box-submit\" type=\"submit\" value=\"LOGIN\">\n";
$loginbox .= "</div>\n";
$loginbox .= "</form>\n";
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
$menu = "";
$menu .= "<div class=\"menu\">\n";
$menu .= "<ul>\n";
$menu .= "<li><a href=\"index.php\">Home</a></li>\n";
$menu .= "<li><a href=\"?pg=keys\">View All Keys</a></li>\n";
$menu .= "<li><a href=\"?pg=keys&view=search\">Search Keys</a></li>\n";
$menu .= "<li><a href=\"?pg=keys&view=add\">Add Key</a></li>\n";
// add admin link if loged in as admin
if (preg_match("/Admin/i", "$usergroup")){
$menu .= "<li class=\"admin\"><a href=\"?pg=admin\">Admin</a></li>\n";
}
$menu .= "<li class=\"log-out\"><a href=\"logout.php\">LogOut</a></li>\n";
$menu .= "<li class=\"welcome\">Hello $username</li>\n";
$menu .= "</ul>\n";
$menu .= "</div>\n";
$menu .= "<div class=\"clear\"></div>";


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
	


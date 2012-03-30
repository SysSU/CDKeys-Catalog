<?php 
// Used throughout the script to choose table in database
$table = "users";

////////////////////////////////////
///////////////////Admin Menu///////
////////////////////////////////////
$adminmenu = "";
$adminmenu .= "<div class=\"sub-menu\" >\n";
$adminmenu .= "<ul>\n";
$adminmenu .= "<li><a href=\"?pg=admin&view=adduser\">Add User</a></li>\n";
$adminmenu .= "</ul>\n";
$adminmenu .= "</div>\n";
$adminmenu .= "<div class=\"clear\" ></div>\n";


////////////////////////////////////
////////Start Content Area//////////
////////////////////////////////////
// IF LOGED IN AS ADMIN
if (preg_match("/Admin/i", "$usergroup")){
// Echo user admin menu


// Include page based on pg variable in URL or display home.php
// This works exactly the same as index.php but searches keys dir in modules
// And uses "view" instead of "pg"
if(isset($_GET['view'])&&$_GET['view']!=""){	
$view = $_GET['view'];
if(file_exists('modules/admin/'.$view.'.php')){	
include ('modules/admin/'.$view.'.php');
}elseif(!file_exists('modules/admin/'.$view.'.php')){	
echo 'Not yet sorry =(';
}
} else {	
include ('modules/admin/home.php');
}







}else{
echo "You do not have access to this part of the site!";

}
?>
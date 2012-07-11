<?php
////////////////////////////////////////
///////////LOGIN PASSWORD///////////////
///////////////////////////////////////
// NO longer used, now moved to database


/////////////////////////////////////////
/////////DATABSE CONNECT INFO////////////
////////////////////////////////////////
//This is the databae hostname, delete what i put and put your info
$dbhost = "localhost";
//This is the database Name, delete what i put and put your info
$dbname = "dbname";
//This is the database Username, delete what i put and put your info
$dbuser = "dbuser";
//This is the database password, delete what i put and put your info
$dbpass = "dbpass";

//////////////////////////////////////////
/////// /COMMON LANGUAGE VARIABLES////////
/////////////////////////////////////////
/*
This makes it very easy to edit some of the content on the site
so you don't have to go searching for it within the script. 
*/
$sitetitle = "CD Key Database";
$pleaselogin = "Welcome to the CD Key Database. Please login to begin.";
$version = "Beta";
$poweredby = "Created by Sel@SysSU";
$poweredbylink = "http://syssu.com";
$hometitle = "What is this?";
$hometext = "This is a CD Key database for storing all your important CD Keys in one central location.
Get started by clicking a link below.";
$viewalltitle = "View All";
$viewalltext = "This is a list of all the CD Keys. You can also search by clicking the link above.";
$searchformtitle = "Search Titles";
$searchformtext = "This only searches titles for right now.";
$searchsuccess = "I HAS SUCCESS! Below is your search results.";
$searchfail = "Sorry could not find any results for your search";
$keydeleted = "It has been deleted!<a href=\"index.php?pg=keys\"> Back to keys </a>";
$keyadded = "Key added, Database Updated. <a href=\"index.php?pg=keys\">Go to Keys</a>";
$keyedited = "Key info changed, Database Updated. ";
$admintitle = "Welcome to the admin area";
$admintext = "Choose from the list below to begin.";
$viewalluserstitleadmin = "User List";
$viewalluserstextadmin = "This is a list of all the users. To edit a user click on the username.";

// DO NOT EDIT BEYOND THIS LINE!!!
$database = mysql_connect($dbhost, $dbuser, $dbpass) or trigger_error(mysql_error(),E_USER_ERROR); 




?>

<?php 
// Used for cd_keys table when connecting to SQL
$table = "cd_keys";
// Include page based on pg variable in URL or display home.php
// This works exactly the same as index.php but searches keys dir in modules
// And uses "view" instead of "pg"
if(isset($_GET['view'])&&$_GET['view']!=""){	
$view = $_GET['view'];
if(file_exists('modules/keys/'.$view.'.php')){	
include ('modules/keys/'.$view.'.php');
}elseif(!file_exists('modules/keys/'.$view.'.php')){	
echo 'No such page';
}
} else {	
include ('modules/keys/home.php');
}

?>

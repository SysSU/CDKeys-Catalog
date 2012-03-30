
<?php 

$homeblock ="";
$homeblock .="<h2>$admintitle</h2>";
$homeblock .="<p>$admintext</p>";
$homeblock .="<ul class=\"body_menu\">";
$homeblock .="<li><a href=\"?pg=admin&view=users\">User Admin</a></li>";
$homeblock .="<li><a href=\"?pg=admin&view=database\">Database Admin</a><br> (Note: Database Admin is for testing but left because it might be useful for someone)</li>";
$homeblock .="</ul>";
$homeblock .="<br>";
$homeblock .="<br>";
echo $homeblock;
		
?>
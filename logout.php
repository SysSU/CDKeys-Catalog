<?php
    session_start();
    $_SESSION['loggedIn'] = false;
    $_SESSION['username'] = "";
    $_SESSION['usergroup'] = "";
?>
You have logged out<br><br>

<a href="index.php">RETURN HOME</a>
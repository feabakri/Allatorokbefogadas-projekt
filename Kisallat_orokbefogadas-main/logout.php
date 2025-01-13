<?php
session_start();
if (isset($_SESSION["user"])) {
    // Beállítjuk a just_logged_out session változót
    $_SESSION['just_logged_out'] = true;
    //Lezárjuk a session-t
    session_unset();
    session_destroy();
    // Átirányítjuk a felhasználót a főoldalra
    header("Location: index.php?logged_out=true");
    exit();
}
header("Location: index.php");
exit();
?>
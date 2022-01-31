<?php 
    setcookie("PHPSESSID", "", time() - 3600, "/");
    session_destroy(); // détruit la session
    header('Location:index.php'); // On redirige
    die();


<?php
    error_reporting(E_ERROR | E_PARSE);
    setcookie("loggedIn", "", time() - 3600, "/");
    setcookie("username", "", time() - 3600, "/");
    setcookie("userID", "", time() - 3600, "/");
    echo "<script> window.location.href = 'login.php'; </script>";
?>

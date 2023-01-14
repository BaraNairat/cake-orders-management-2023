<?php
    unset($_SESSION['userInfo']); // Clears the $_SESSION variable
    session_destroy();
    header('location:login.php');
?>
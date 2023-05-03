<?php
    session_start();
    unset($_SESSION['userName']);
    unset($_SESSION['role']);
    header('Location:index.php');
?>
<?php 

    session_start();

    if(isset($_SESSION["username"]) && isset($_SESSION["id"])) {
        session_destroy();

        header('Location:/blog/auth/login.php');
    }
?>
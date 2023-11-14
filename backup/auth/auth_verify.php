<?php

include '../services/pdo.php';

session_start();

try {

    $stmt = $base->prepare("SELECT * FROM users WHERE username = :username AND password = :password;");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":password", $password, PDO::PARAM_STR);

    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($_POST['old_path'])) {

        $old_path = $_POST['old_path'];

        $_SESSION['id'] = $result['id'];
        $_SESSION['username'] = $result['username'];

        header("Location:$old_path");
    } else if ($result) {
        $_SESSION['id'] = $result['id'];
        $_SESSION['username'] = $result['username'];

        header("Location:/blog/articles/show.php");
    } else {
        $old_path = $_POST['old_path'];
        $old_path ? header("Location:/blog/auth/login.php?error?old_path=$old_path") : header("Location:/blog/auth/login.php?error");
    }
} catch (Exception $e) {

}
?>
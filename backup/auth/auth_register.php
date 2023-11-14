<?php 

    include '../services/pdo.php';

    try {
        $stmt = $base->prepare('SELECT username FROM users WHERE username = :username');

        $stmt->bindParam(':username', htmlspecialchars($_POST['username']), PDO::PARAM_STR);
        $stmt->execute();

        if($result = $stmt->fetch()) {
            header('Location:/blog/auth/register.php?username_taken');
        } else {
            session_start();

            $stmt = $base->prepare('INSERT INTO users (id, username, password) VALUES (:id, :username, :password)');

            $id = uniqid();
            $specialUsername = htmlspecialchars($_POST['username']);
            $specialPassword = htmlspecialchars($_POST['password']);

            $_SESSION['id'] = $id;
            $_SESSION['username'] = $specialUsername;

            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':username', $specialUsername, PDO::PARAM_STR);
            $stmt->bindParam(':password', $specialPassword, PDO::PARAM_STR);

            $stmt->execute();

            header('Location:/blog/articles/show.php');
        }
    } catch (PDOException $e) {

    }

?> 
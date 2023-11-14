<?php
include '../services/pdo.php';
session_start();

    if(isset($_POST['article_id']) && isset($_POST['article_img'])) {
        try {
            $stmt = $base->prepare('DELETE FROM articles WHERE id = :id');
    
            $stmt->bindParam(':id', $_POST['article_id'], PDO::PARAM_STR);

            if($stmt = $stmt->execute()) {
                $images = scandir('tmp_img/');

                var_dump($images);
            }

            // header('Location:/blog/articles/show.php');
        } catch (PDOException $e) {
            echo ''. $e->getMessage() .'';
        }
    } else {
        header('Location:/blog/articles/show.php?404');
    }
?>
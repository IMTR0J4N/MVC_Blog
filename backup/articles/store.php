<?php
include '../services/pdo.php';
session_start();
    if (isset($_POST)) {
        $target_dir = "tmp_img/";
        $uploadedImgExt = pathinfo($_FILES["file_send"]["name"], PATHINFO_EXTENSION);
        $uuidUploadedImg = uniqid() . "." . $uploadedImgExt;
        $target_file = $target_dir . $uuidUploadedImg;
        $uid = uniqid();
        if (move_uploaded_file($_FILES["file_send"]["tmp_name"], $target_file)) {
            try {
                $stmt = $base->prepare("INSERT INTO articles (id, title, comment, image, created_at, author_id) VALUES (?,?,?,?,?,?)");
                $stmt->bindParam(1, $uid, PDO::PARAM_STR);
                $stmt->bindParam(2, htmlspecialchars($_POST["title"]), PDO::PARAM_STR);
                $stmt->bindParam(3, htmlspecialchars($_POST["comments"]), PDO::PARAM_STR);
                $stmt->bindParam(4, $uuidUploadedImg, PDO::PARAM_STR);
                $stmt->bindParam(5, date("Y-m-d H:i:s"));
                $stmt->bindParam(6, $_SESSION['id'], PDO::PARAM_STR);
                $stmt->execute();

                header("Location:/blog/articles/show.php?success_create");
            } catch (PDOException $e) {
                header("Location:/blog/articles/show.php?error_create");
            }
        } else {
            header("Location:/blog/articles/show.php?error_create");
        }

    } else {
        header("Location:/blog/articles/show.php?error_create");
    }
?>
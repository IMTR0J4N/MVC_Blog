<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <title>Show Blog Articles</title>
</head>

<body>
    <?php

    include '../services/pdo.php';
    include '../components/navbar.php';

    ?>
    <div class="container">
        <div class="position-relative d-flex justify-content-center flex-column">
            <h2>Posts</h2>

            <main>
                <?php
                if (isset($_GET["success_create"])) { ?>
                    <div class="alert alert-success" role="alert">
                        Article créer avec succès
                    </div>
                <?php } else if (isset($_GET["error_create"])) { ?>
                        <div class="alert alert-danger" role="alert">
                            Erreur lors de la création de l'article
                        </div>
                <?php } ?>
                <div class="d-flex justify-content-around flex-wrap">

                    <?php $stmt = $base->prepare('SELECT * FROM articles');

                    $stmt->execute();

                    $row = $stmt->fetchAll();

                    foreach ($row as $value) {
                        $article_id = $value['id'];
                        $article_img = $value['image'];
                        ?>

                        <article class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img class="img-fluid rounded-start" src="<?php echo "tmp_img/" . $value["image"] ?>"
                                        style="width: auto; height: 200px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $value['title']; ?>
                                        </h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary">
                                            <?php
                                            $stmt = $base->prepare('SELECT username FROM users WHERE id = :id');

                                            $stmt->bindParam(':id', $value['author_id'], PDO::PARAM_STR);

                                            $stmt->execute();

                                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                            echo $result['username'] . " • " . $value['created_at'];
                                            ?>
                                        </h6>
                                        <p class="card-text">
                                            <?php echo $value['comment'] ?>
                                        </p>
                                        <?php
                                        if (isset($_SESSION['id']) && $value['author_id'] === $_SESSION['id']) { ?>
                                            <div class="d-flex flex-row gap-3">
                                                <form action="<?php echo "/blog/articles/delete.php" ?>" method="POST">
                                                    <button class="btn btn-danger">
                                                        Supprimer
                                                    </button>
                                                    <input type="hidden" name="article_id" value="<?php echo $article_id ?>">
                                                    <input type="hidden" name="article_img" value="<?php echo $article_img ?>">
                                                </form>
                                                <form action="<?php echo "/blog/articles/edit.php" ?>" method="POST">
                                                    <button class="btn btn-warning">
                                                        Modifier
                                                    </button>
                                                    <input type="hidden" name="article_id" value="<?php echo $article_id ?>">
                                                </form>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php }
                    ?>




                </div>
            </main>
        </div>
    </div>
</body>

</html>
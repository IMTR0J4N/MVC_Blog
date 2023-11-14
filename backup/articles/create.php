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
    <title>Create Article</title>
</head>

<body>
    <?php
    include '../services/pdo.php';
    include '../components/navbar.php';

    if (isset($_SESSION['id'])) {
    ?>
            <div class="container">
                <div class="position-relative d-flex justify-content-center flex-column">
                    <h1>Ajouter un Article au Blog</h1>
                    <form action="store.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">

                            <div class="col">
                                <label for="title">Title :</label>
                                <input class="form-control" type="text" id="title" name="title">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex">
                                <input type="file" accept="image/png, image/jpeg" name="file_send" id="file_send" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="username">Description :</label>
                            <textarea class="form-control" id="comments" name="comments"></textarea>
                        </div>

                                <button class="btn btn-primary">Sauvegarder</button>
                            </form>
                        </div>
                    </div>
                <?php
    } else {
        $old_path = $_SERVER['REQUEST_URI'];
        header("Location:/blog/auth/login.php?login_required&old_path=$old_path");
    }
    ?>
</body>

</html>
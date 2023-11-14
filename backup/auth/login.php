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
    <title>Blog Log-In</title>
</head>

<body>

    <?php
    include '../components/navbar.php';
    ?>

    <div class="container">
        <div class="position-relative d-flex justify-content-center flex-column">
            <h1>Se connecter</h1>

            <form action="auth_verify.php" method="POST">

                <?php
                if (isset($_SESSION['id'])) {
                    header('Location:/blog/articles/show.php');
                } else {
                    if (isset($_GET['error'])) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Username or Password incorrect
                        </div>
                        <?php
                    } else if(isset($_GET['login_required']) && isset($_GET['old_path'])) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            You need to Log-In for this action
                        </div>
                        <?php
                    }
                    ?>
                    <div class="mb-3">
                        <label for="username">Username :</label>
                        <input class="form-control" type="text" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password :</label>
                        <input class="form-control" type="password" id="password" name="password">
                    </div>
                    <button class="btn btn-primary">Se connecter</button>
                    <?php
                        if(isset($_GET['old_path'])) {
                    ?>
                        <input type="hidden" name="old_path" value="<?php echo $_GET['old_path'];?>">
                    <?php
                        }
                }
                ?> 
                <div class="position-absolute bottom-0 end-0">
                    <span><a class="link-opacity-50-hover" href="/blog/auth/register.php">s'enregistrer</a></span>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
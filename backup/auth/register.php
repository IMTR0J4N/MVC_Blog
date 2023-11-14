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
    <title>Register</title>
</head>

<body>
    <?php
    include '../components/navbar.php';
    ?>
    <div class="container">
        <div class="position-relative d-flex justify-content-center flex-column">
            <h1>S'enregistrer</h1>

            <form action="auth_register.php" method="POST">
                <div class="mb-3">
                    <label for="username">Username :</label>
                    <?php
                    if (isset($_GET['username_taken'])) {
                        ?>
                        <input class="form-control is-invalid" type="text" id="username" name="username">
                        <div id="usernameFeedback" class="invalid-feedback">
                            Username already taken
                        </div>
                        <?php
                    } else {
                        ?>
                        <input class="form-control" type="text" id="username" name="username">
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="password">Password :</label>
                    <input class="form-control" type="password" id="password" name="password">
                </div>
                <button class="btn btn-primary">S'enregister</button>
                <div class="position-absolute bottom-0 end-0">
                    <span><a class="link-opacity-50-hover" href="{{ route('login') }}">se connecter</a></span>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
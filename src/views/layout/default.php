<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Blog</title>
</head>
<body>
<header>
    <?php
    if(isset($_SESSION)) var_dump($_SESSION);
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container-fluid">
            <a class="navbar-brand">Blog</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="/blog/articles" class="nav-link active">Show Articles</a>
                    </li>
                    <li class="nav-item">
                        <a href="/blog/articles/create" class="nav-link active">Create Articles</a>
                    </li>
                </ul>
            </div>
            <?php
            if (isset($_SESSION['id'])) { ?>
                <div class="navbar-nav btn-group dropstart">
                    <button type="button" class="btn btn-secondary dropdown-toggle nav-item" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <?php
                        echo $_SESSION['username'];
                        ?>
                    </button>
                    <ul class="dropdown-menu mr-3">
                        <li><a class="dropdown-item" href="/blog/auth/disconnect">Déconnection</a></li>
                    </ul>
                </div>
                <?php
            } else {
                ?>
                <div class="navbar-nav btn-group dropstart">
                    <button type="button" class="btn btn-warning dropdown-toggle nav-item" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        Non connecté
                    </button>
                    <ul class="dropdown-menu mr-3">
                        <li><a class="dropdown-item" href="/auth/login">Se connecter</a></li>
                        <li><a class="dropdown-item" href="/auth/register">S'enregistrer</a></li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </nav>
</header>
<main>
    <?= $content ?>
</main>
</body>
</html>
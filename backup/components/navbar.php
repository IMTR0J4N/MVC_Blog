<?php

session_start();

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand">Blog</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="/blog/articles/show.php" class="nav-link active">Show Articles</a>
                </li>
                <li class="nav-item">
                    <a href="/blog/articles/create.php" class="nav-link active">Create Articles</a>
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
                    <li><a class="dropdown-item" href="/blog/auth/disconnect.php">Déconnection</a></li>
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
                    <li><a class="dropdown-item" href="/blog/auth/login.php">Se connecter</a></li>
                    <li><a class="dropdown-item" href="/blog/auth/register.php">S'enregistrer</a></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</nav>
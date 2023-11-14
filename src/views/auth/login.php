<div class="container">
        <div class="position-relative d-flex justify-content-center flex-column">
            <h1>Se connecter</h1>

            <form action="/blog/auth/doLogin" method="POST">

                <?php
                if (isset($_SESSION['id'])) {
                    header('Location:/blog/articles');
                } else {
                    if (isset($_GET['error'])) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Username or Password incorrect
                        </div>
                        <?php
                    } else if(isset($_GET['login_required'])) {
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
                    <span><a class="link-opacity-50-hover" href="/blog/auth/register">s'enregistrer</a></span>
                </div>

                <?php echo isset($_GET['old_path']) ? "<input type='hidden' name='old_path' value=".$_GET["old_path"].">" : ''?>
            </form>
        </div>
    </div>

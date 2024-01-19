<div class="container">
    <div class="position-relative d-flex justify-content-center flex-column">
        <h2>Posts</h2>

        <main>
            <div class="d-flex justify-content-around flex-wrap">

            <?php   foreach ($posts as $value) {
                    $postId = $value['id'];
                    $postImg = $value['image'];
                    ?>

                    <article class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img class="img-fluid rounded-start" src="<?= "img/$postImg" ?>" style="width: auto; height: 200px;" alt="article illustration"/>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $value['title']; ?>
                                    </h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">

                                    </h6>
                                    <p class="card-text">
                                        <?php echo $value['comment'] ?>
                                    </p>
                                    <?php
                                    if (isset($_SESSION['id']) && $value['author_id'] === $_SESSION['id']) { ?>
                                        <div class="d-flex flex-row gap-3">
                                            <form action="<?php echo "/blog/posts/delete.php" ?>" method="POST">
                                                <button class="btn btn-danger">
                                                    Supprimer
                                                </button>
                                                <input type="hidden" name="article_id" value="<?php echo $article_id ?>">
                                                <input type="hidden" name="article_img" value="<?php echo $article_img ?>">
                                            </form>
                                            <form action="<?php echo "/blog/posts/edit.php" ?>" method="POST">
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
<?php

include 'app/controllers/topics.php';

$post = selectPostFromPostsWithUsersOnSingle('posts', 'users', $_GET['post']);




?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>
<body>
<?php require_once "app/blocks/header.php" ?>
<div class="container">
    <div class="row">
        <div class="main-content col-md-9 my-4">
            <h1 class="m-3"><?= $post['title'] ?></h1>

            <div class="single_post row">
                <div class="">
                    <img src="<?= 'assets/img/posts/' . $post['img'] ?>" lt="<?= $post['title'] ?>"
                         class="img-fluid mx-3" width="900" height="400">
                </div>
                <div class="col-md-12">
                    <div class="row m-2">
                        <div class="d-inline-flex">
                            <p class="text-muted me-5 ">
                                <i class="bi bi-calendar-event"></i> <?= $post['created_date'] ?>
                            </p>
                            <p class="text-muted">
                                <i class="bi bi-person"></i><?= $post['username'] ?>
                            </p>
                        </div>
                        <?= $post['content'] ?>
                    </div>
                </div>
                <?php if (!empty($_SESSION)): ?>
                    <div class="like-button mt-3 ms-3">
                        <button  class="heart-button btn btn-light d-flex justify-content-center align-items-center" type="submit" data-post-id="<?php echo $post['id']; ?>">
                            <i  class="bi <?php echo (isLiked($post['id'], $_SESSION['id'])) ? 'bi-heart-fill' : 'bi-heart'; ?>"></i>
                            <span class="counter"><?= getLikesCount($post['id']) ?></span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php require_once "app/blocks/comments_block.php" ?>
            </div>
        </div>


        <div class="sidebar col-md-3 mt-5">
            <?php require_once ROOT_PATH . "/app/blocks/sidebar.php"; ?>
        </div>

    </div>
</div>
<?php include "app/blocks/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="assets/js/main.js"></script>

</body>
</html>

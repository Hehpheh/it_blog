<?php
include "app/href.php";
include  'app/controllers/topics.php';

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['search-btn'])){
    $posts=seacrhInTitileAndContent($_POST['search-text'],'posts','users');

}



?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>
<body>
<?php require_once "app/blocks/header.php" ?>

<div class="container">
    <div class="row">
        <div class="main-content col-md-9 my-4" >
            <h3 class="m-3">Результаты поиска:</h3>
            <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post):?>
                <div class="post">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?='assets/img/posts/'.$post['img']?>" alt="<?=$post['title']?>" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <h3> <a href="<?='single.php?post='.$post['id']?>"><?=substr($post['title'],0,120).'...'?></a></h3>
                                <div class="row">
                                    <div class="d-inline-flex  ">
                                        <p class="text-muted me-4 ">
                                            <i<p class="text-muted inline">
                                            <i class="bi bi-calendar-event"></i> <?=$post['created_date']?>
                                        </p>
                                        <p class="text-muted">
                                            <i class="bi bi-person"></i> <?=$post['username']?>
                                        </p>
                                    </div>
                                    <p> <?=mb_substr($post['content'], 0, 155, 'UTF-8'). '...'  ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php else: ?>

                <div class="m-5 text-center">
                    <h5 class="p-5 text-center text-secondary">По данному запросу ничего не найдено!</h5>
                </div>
            <?php endif; ?>
        </div>
        <!--sidebar  content-->

        <div class="sidebar col-md-3 mt-4 p-3">
            <?php require_once ROOT_PATH . "/app/blocks/sidebar.php"; ?>
        </div>
    </div>


</div>
</div>
<div class="<?php if (empty($posts)): ?>bottom-page<?php endif; ?>">
    <?php require_once "app/blocks/footer.php" ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
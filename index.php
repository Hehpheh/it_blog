 <?php

 include "app/href.php";
 include  'app/controllers/topics.php';

 $page = isset($_GET['page']) ? $_GET['page']: 1;
 $limit=2;
 $offset = $limit * ($page - 1);

 $posts=selectAllFromPostsWithUsersOnIndex('posts','users',$limit, $offset);
 $total_pages = ceil(countRow('posts', ['status' => 1]) / $limit);



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


<div class="row justify-content-center align-items-center home-description">

    <div class=" text-center my-5">
        <h2><strong>Технологии. Сообщество. Инновации.</strong></h2>
        <p>Присоединяйтесь к LOGO и становитесь частью сообщества, где технологии, знания и опыт объединяются для инноваций.</div>
</div>
<!--main  content-->

<div class="container">

    <div class="row">
        <div class="col-md-9 my-5" >
            <h1 class="m-3">Последние публикации:</h1>
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
                                        <i class="bi bi-person"></i>
                                        <?php if ( $post['id_user']===$_SESSION['id']):?>
                                            <a class="" href="<?= BASE_URL ."/account.php?id=".$_SESSION['id'] ?>"><?php echo $_SESSION['username']; ?></a>
                                        <?php else: ?>
                                        <a href="another_user.php?id=<?php echo $post['id_user']; ?>"><?php echo $post['username']; ?></a>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <p> <?=mb_substr($post['content'], 0, 155, 'UTF-8'). '...'  ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php require_once "app/blocks/pagination.php" ?>

        </div>
        <!--sidebar  content-->
        <div class=" col-md-3 mt-5 mb-3">
            <?php require_once ROOT_PATH . "/app/blocks/sidebar.php"; ?>

        </div>
    </div>

</div>

<?php require_once "app/blocks/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
 </html>
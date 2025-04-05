<?php include "app/controllers/posts.php";


?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Управление записями</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>
<body>
<?php require_once "app/blocks/header-admin.php" ?>


<!--main  content-->
<div class="container-fluid admin-panel">

    <div class="row">

        <?php require_once "app/blocks/sidebar-admin.php" ?>

        <div class="admin-content-area col-md-8 m-3 ">
            <div class="card ">
                <div class="card-body">
                    <div class="button row m-3">
                        <a href="create.php" class="col-3 btn btn-success me-2 ">Добавить пост</a>
                    </div>
                    <h2 class="text-center">Управление записями</h2>
                    <div class="card-header row ">
                        <div class="col-1">ID</div>
                        <div class="col-3">Название</div>
                        <div class="col-2">Автор</div>
                        <div class="col-6">Управление</div>
                    </div>
                    <?php foreach ($postsAdm  as $key => $post): ?>
                        <div class="row post  p-3  border-bottom">
                            <div class="col-1"><?php echo $key+1 ?></div>
                            <div class="col-3">
                                <?=mb_substr($post['title'], 0, 40, 'UTF-8'). '...'  ?>
                            </div>
                            <div class="col-2"><?php echo $post['username']?></div>
                            <div class="col-2"><a class="text-success" href="edit.php?id=<?php echo $post['id']; ?> ">Edit</a></div>
                            <div class="col-2 "><a class="text-danger" href="edit.php?del_id=<?php echo $post['id'];?>">Delete</a></div>
                            <?php if($post['status']): ?>
                            <div class="col-2 "><a href="edit.php?status=0&pub_id=<?=$post['id'];?>">В черновик</a></div>
                            <?php else: ?>
                                <div class="col-2 "><a href="edit.php?status=1&pub_id=<?=$post['id'];?>">Опубликовать</a></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
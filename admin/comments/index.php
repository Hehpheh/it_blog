<?php

include_once "app/database/db.php";
include_once "app/href.php";

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 5;
$offset = $limit * ($page - 1);

$commentsAdm = selectAllFromCommentsAdm('comments', 'users', $limit, $offset);
$total_pages = ceil(countRow('comments') / $limit);

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Управление комментариями</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
<?php require_once "app/blocks/header-admin.php" ?>

<!--main content-->
<div class="container-fluid admin-panel">
    <div class="row">
        <?php require_once "app/blocks/sidebar-admin.php" ?>

        <div class="comments col-md-8 m-3">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center py-3">Управление комментариями</h2>

                    <div class="card-header row">
                        <div class="col-1">ID</div>
                        <div class="col-3">Email</div>
                        <div class="col-4">Текст сообщения</div>
                        <div class="col-2">Дата</div>
                        <!--Новый столбец для даты-->
                        <div class="col-2">Управление</div>
                    </div>

                    <?php foreach ($commentsAdm as $key => $comment): ?>
                        <div class="row comment p-3 border-bottom">
                            <div class="col-1"><?php echo $comment['id']; ?></div>
                            <div class="col-3"><?php echo htmlspecialchars($comment['email'], ENT_QUOTES, 'UTF-8'); ?></div>
                            <div class="col-4">
                                <?php
                                $message = htmlspecialchars($comment['commentText'], ENT_QUOTES, 'UTF-8');
                                echo mb_substr($message, 0, 50) . (mb_strlen($message) > 50 ? '...' : '');
                                ?>
                            </div>
                            <div class="col-2"><?php echo date('d.m.Y H:i', strtotime($comment['created_date'])); ?></div>
                            <div class="col-2">
                                <a class="text-danger" href="index.php?del_id=<?php echo $comment['id']; ?>">Удалить</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php require_once ROOT_PATH . "/app/blocks/pagination.php" ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include "app/controllers/users.php";
?>
<!doctype html>
<html lang="ru">
<head>
    scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Управление пользователями</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
<div>
    <?php require_once "app/blocks/header-admin.php" ?>
    <div class="container-fluid admin-panel">
        <div class="row">
            <?php require_once "app/blocks/sidebar-admin.php" ?>
            <div class="posts col-md-8 m-3">
                <div class="card">
                    <div class="card-body">
                        <div class="button row m-3">
                            <a href="create.php" class="col-4 btn btn-success">Добавить пользователя</a>
                        </div>
                        <h2 class="text-center">Управление пользователями</h2>

                        <div class="card-header row">
                            <div class="col-1">ID</div>
                            <div class="col-4">Логин</div>
                            <div class="col-4">Email</div>
                            <div class="col-3">Управление</div>
                        </div>

                        <?php foreach ($users as $user): ?>
                            <div class="row p-3 border-bottom">
                                <div class="col-1"><?= $user['id'] ?></div>
                                <div class="col-4"><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></div>
                                <div class="col-4"><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></div>
                                <div class="col-1">
                                    <a class="text-success" href="edit.php?id=<?= $user['id'] ?>">Edit</a>
                                </div>
                                <div class="col-1">
                                    <a class="text-danger" href="index.php?del_id=<?= $user['id'] ?>">Delete</a>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</div>
</body>
</html>
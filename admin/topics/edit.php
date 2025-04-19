<?php

include "app/href.php";
include "app/controllers/topics.php";
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактироание категории</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>

<?php require_once "app/blocks/header-admin.php"; ?>

<div class="container-fluid admin-panel">

    <div class="row">
        <?php require_once "app/blocks/sidebar-admin.php"; ?>

        <div class="posts col-md-8 m-3">
            <div class="card">
                <div class="card-body">
                    <div class="button row m-3">
                        <a href="index.php" class="col-4 btn btn-warning">Управление категориями</a>
                    </div>
                    <h2 class="text-center">Редактирование категории</h2>
                    <?php if (!empty($errMsg)): ?>
                        <?php if (is_array($errMsg)): ?>
                            <?php foreach ($errMsg as $error): ?>
                                <div class="alert alert-danger text-center" >
                                    <?= $error ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-danger text-center" >
                                <?= $errMsg ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <form method="post" action="edit.php">
                        <input value="<?=$id?>" type="hidden" class="form-control" name="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Название категории:</label>
                            <input value="<?=$name?>" type="text" class="form-control" name="name" placeholder="Введите название категории" required>
                        </div>
                        <button name="topic-edit" type="submit" class="btn btn-primary">Изменить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include "app/href.php";
include "app/controllers/topics.php";
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Управление категориями</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>

<?php require_once "app/blocks/header-admin.php" ?>

<div class="container-fluid admin-panel">

    <div class="row">
        <?php require_once "app/blocks/sidebar-admin.php" ?>

        <div class="col-md-8 m-3">
            <div class="card">
                <div class="card-body">
                    <div class="button row m-3">
                        <a href="create.php" class="col-4 btn btn-success me-2">Добавить категорию</a>
                    </div>
                    <h2 class="text-center">Управление категориями</h2>
                    <div class="card-header row">
                        <div class="col-1">ID</div>
                        <div class="col-4">Название</div>
                        <div class="col-5">Управление</div>
                    </div>
                    <?php foreach ($topics as $key => $topic): ?>
                        <div class="row p-3 border-bottom">
                            <div class="col-1"><?php echo $key + 1 ?></div>
                            <div class="col-4"><?php echo $topic['name']?></div>
                            <div class="col-2">
                                <a class="text-success" href="edit.php?id=<?php echo $topic['id']; ?>">Edit</a>
                            </div>
                            <div class="col-2">
                                <a class="text-danger" href="edit.php?del_id=<?php echo $topic['id']; ?>">Delete</a>
                            </div>
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
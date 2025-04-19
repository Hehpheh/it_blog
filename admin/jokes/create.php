<?php
include "app/href.php";
include "app/controllers/jokes.php";
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавление шутки</title>
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
                        <a href="index.php" class="col-4 btn btn-warning">Управление шутками</a>
                    </div>
                    <h2 class="text-center">Добавление шутки</h2>
                    <form method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Шутка:</label>
                            <textarea type="text" class="form-control" name="text" placeholder="Введите шутку" required><?=$text?></textarea>
                        </div>
                        <button name="joke-creat" type="submit" class="btn btn-primary">Добавить</button>
                        <div class="mb-3 p-3 text-center err">
                            <?= $errMsg ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
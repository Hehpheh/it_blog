<?php
include "app/controllers/users.php";
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Изменение пользователя</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>
<body>
<?php require_once "app/blocks/header-admin.php" ?>
<div class="container-fluid admin-panel">

    <div class="row">
        <?php require_once "app/blocks/sidebar-admin.php" ?>
        <div class="posts col-md-8 m-3 ">
            <div class="card ">
                <div class="card-body">
                    <div class="button row m-3">
                        <a href="index.php" class="col-4 btn btn-warning">Управление пользователями</a>
                    </div>
                    <form action="edit.php" method="post">
                        <h2 class="text-center">Изменение пользователя</h2>
                        <div class="mb-3 p-3 err">
                            <?= $errMsg ?>
                        </div>
                        <input type="hidden" name="id" value="<?=$id?>">
                        <div class="mb-3">
                            <label for="regLogin" class="form-label">Логин</label>
                            <input type="text" value="<?= $username ?>" class="form-control" name="username"
                                   placeholder="Введите логин">
                        </div>
                        <div class="mb-3">
                            <label for="regEmail" class="form-label">Email</label>
                            <input type="email" value="<?= $email ?>" class="form-control" name="email"
                                   placeholder="Введите email">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Роль</label>
                            <select class="form-select" id="role" name="role">
                                <option value="user" <?php if($admin == 0) echo "selected"?> >User</option>
                                <option value="admin" <?php if($admin == 1) echo "selected"?> >Admin</option>
                            </select>
                        </div>
                        <button type="submit" name="button-edit" class="btn btn-primary">Изменить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
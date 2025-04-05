<?php
include "app/controllers/users.php";
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>
<div>
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
                    <h2 class="text-center">Добавление пользователя</h2>
                    <form action="create.php" method="post">
                        <div class="mb-3 p-3 err">
                            <?= $errMsg ?>
                        </div>
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
                            <label for="regPassword" class="form-label">Пароль</label>
                            <input type="password" class="form-control" name="password"
                                   placeholder="Введите пароль">
                        </div>
                        <div class="mb-3">
                            <label for="regPasswordConfirm" class="form-label">Подтвердите пароль</label>
                            <input type="password" class="form-control" name="password_confirm"
                                   placeholder="Подтвердите пароль">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Роль</label>
                            <select class="form-select" id="role" name="role">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" name="button-create" class="btn btn-primary">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</div>
</html>
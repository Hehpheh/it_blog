<?php include "app/controllers/users.php" ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>
<body>
<?php require_once "app/blocks/header.php" ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 my-5">
            <form method="post" action="reg.php">
                <h2 class="text-center">Регистрация</h2>
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
                <div class="mb-3">
                    <label for="regLogin" class="form-label">Логин</label>
                    <input type="text" value="<?= $username ?>" class="form-control" name="username" placeholder="Введите логин">
                </div>
                <div class="mb-3">
                    <label for="regEmail" class="form-label">Email</label>
                    <input type="email" value="<?= $email ?>" class="form-control" name="email" placeholder="Введите email">
                </div>
                <div class="mb-3">
                    <label for="regPassword" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password" placeholder="Введите пароль">
                </div>
                <div class="mb-3">
                    <label for="regPasswordConfirm" class="form-label">Подтвердите пароль</label>
                    <input type="password" class="form-control" name="password_confirm" placeholder="Подтвердите пароль">
                </div>
                <div class="d-flex justify-content-between">
                    <div><button type="submit" name="button-reg" class="btn btn-dark">Зарегистрироваться</button></div>
                    <div><a href="auth.php" class="btn btn-link">Войти</a></div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once "app/blocks/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

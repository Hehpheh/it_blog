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
            <form method="post" action="auth.php">
                <h2 class="text-center">Авторизация</h2>
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
                    <label for="loginEmail" class="form-label">Email</label>
                    <input name="email"  value=" <?=  $email  ?>"  type="email" class="form-control" aria-describedby="emailHelp" placeholder="Введите email">
                    <div  class="form-text text-muted">Мы никогда не передадим ваш email третьим лицам.</div>
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Пароль</label>
                    <input name="pass" type="password" class="form-control"  placeholder="Введите пароль">
                </div>
                <div class="d-flex justify-content-between">
                    <div><button type="submit" name="button-auth" class="btn btn-dark">Войти</button></div>
                    <div><a href="reg.php" class="btn btn-link">Зарегистрироваться</a></div>
                </div>

            </form>
        </div>
    </div>
</div>
<div class="bottom-page">
    <?php require_once "app/blocks/footer.php" ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

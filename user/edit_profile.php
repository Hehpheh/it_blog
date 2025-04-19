<?php
include "app/href.php";
include 'app/controllers/user_acc.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Редактирование профиля</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
<?php include "app/blocks/header.php"; ?>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 m-3">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center p-2">Редактирование профиля</h2>
                    <?php if (!empty($errMsg)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errMsg as $error): ?>
                                <p><?php echo htmlspecialchars($error); ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="edit_profile.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="username" class="form-label">Логин пользователя</label>
                            <input type="text" class="form-control" id="username" name="username"
                                   value="<?php echo htmlspecialchars($user['username']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?php echo htmlspecialchars($user['email']); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <input type="description" class="form-control" id="description" name="description"
                                   value="<?php echo htmlspecialchars($user['description']); ?>">
                            <div  class="form-text ps-1">Не обязательно</div>
                        </div>


                        <div class="mb-3">
                            <label for="formFile" class="form-label">Аватар</label>
                            <input name="img" class="form-control" type="file" id="formFile">
                            <div id="imageHelp" class="form-text ps-1">Не обязательно</div>
                        </div>



                        <div class="mb-3">
                            <label for="old_password" class="form-label">Текущий пароль</label>
                            <input type="password" class="form-control" id="old_password" name="old_password">
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Новый пароль</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_new_password" class="form-label">Подтвердите новый пароль</label>
                            <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password">
                        </div>



                        <div class="d-flex justify-content-between">
                            <button name="edit-profile" type="submit" class="btn btn-primary">Изменить</button>
                            <a href="delete_profile.php" class="btn btn-danger">Удалить профиль</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <?php require_once "app/blocks/footer.php" ?>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

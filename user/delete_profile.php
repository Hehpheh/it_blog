<?php
include_once "app/href.php";
include_once 'app/controllers/user_acc.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Подтверждение удаления профиля</title>
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
                    <h2 class="text-center p-2">Подтверждение удаления профиля</h2>
                    <p class="text-center">Вы уверены, что хотите удалить свой профиль? Эта операция необратима и все ваши данные будут удалены.</p>..
                    <div class="text-center">
                        <form method="post">
                            <button type="submit" name="confirm_delete" class="btn btn-danger">Удалить все равно</button>
                            <a href="<?= BASE_URL . "/account.php?id=" . $_SESSION['id'] ?>"
                               class="btn btn-secondary">Нет, не хочу</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bottom-page">
    <?php require_once "app/blocks/footer.php" ?>
</div>
</body>
</html>
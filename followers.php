<?php
include "app/href.php";
include  'app/controllers/topics.php';

$followers=selectAll('followers',['author_id'=>$_SESSION['id']]);

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Мои подписчики</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
<?php require_once "app/blocks/header.php" ?>

<div class="container">
    <div class="row">
        <div class="col-md-9 my-5" >
            <h1 class="m-3">Мои подписчики</h1>
            <?php if (empty($followers)): ?>
                <p class="m-3">У вас пока нет подписчиков.</p>
            <?php else: ?>
                <?php foreach ($followers as $follower):
                    // Получаем данные пользователя (подписчика)
                    $user = selectOne('users', ['id' => $follower['follower_id']]);

                    if (!empty($user['img'])) {
                        $imgUrl = BASE_URL . "/assets/img/users/" . $user['img'];
                    } else {

                        $imgUrl = BASE_URL . "/assets/img/default_avatar.png";
                    }

                    if ($user):
                        ?>

                        <div class="card follower-card mb-3">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-2">
                                    <div class="follower-card-img-wrapper">
                                        <img src="<?=$imgUrl ?>" class="follower-card-img img-fluid rounded-circle" alt="Фото пользователя"> <!-- Закругленные углы -->
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body">
                                        <h5 class="card-title follower-card-title "><?= htmlspecialchars($user['username']) ?></h5>
                                        <p class="card-text follower-card-bio"><?=$user['description']; ?></p>
                                        <a href="another_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-outline-primary">Профиль</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endif; // Закрываем if ($user)
                endforeach; ?>
            <?php endif; ?>
            <?php require_once "app/blocks/pagination.php" ?>
        </div>
        <!--sidebar  content-->
        <div class=" col-md-3 mt-5 mb-3">
            <?php require_once ROOT_PATH . "/app/blocks/sidebar.php"; ?>
        </div>
    </div>
</div>

<?php require_once "app/blocks/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
<?php
define('ROOT_DIR', __DIR__);
include ROOT_DIR . '/app/controllers/topics.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10;
$offset = $limit * ($page - 1);

$posts = selectAllFromPostsWithUsersById('posts', 'users', $id, $limit, $offset);

$user = selectOne('users', ['id' => $id]);

$total_pages = ceil(countRow('posts', ['id_user' => $id]) / $limit);
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Аккаунт</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
<?php require_once "app/blocks/header.php" ?>

<div class="container">
    <div class="d-flex mt-3">
        <div class="col-md-4">
            <div class="row me-5">
                <div class="profile-header">
                    <div class="d-flex flex-column align-items-center">
                        <div class="profile-picture mb-2">
                            <?php
                            if (!empty($user['img'])) {
                                $imgUrl = BASE_URL . "/assets/img/users/" . $user['img'];
                            } else {
                                $imgUrl = BASE_URL . "/assets/img/default_avatar.png";
                            }
                            echo '<img src="' . $imgUrl . '" alt="Аватар пользователя" class="profile-avatar">';
                            ?>
                        </div>
                        <h1 class="profile-name"><?php echo htmlspecialchars($user['username']); ?></h1>
                        <?php if (isset($_SESSION['id']) && $user !== null) {
                            $follower_id = $_SESSION['id'];
                            $author_id = $user['id'];

                            $existing_follow = selectOne('followers', ['follower_id' => $follower_id, 'author_id' => $author_id]);
                            $is_following = !empty($existing_follow);

                            $button_text = $is_following ? 'Отписаться' : 'Подписаться';
                            $button_class = $is_following ? 'btn-secondary' : 'btn-primary';

                            echo "<button class='follow-button btn {$button_class}' data-author-id='{$author_id}'>{$button_text}</button>";
                        }
                        ?>
                    </div>
                </div>
                <div class="my-4">
                    <?php require_once ROOT_PATH . "/app/blocks/sidebar.php"; ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h1>Статьи:</h1>
            <div class="row">
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                <div class="post">
                    <div class="container mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?= 'assets/img/posts/' . $post['img'] ?>"
                                     alt="<?= $post['title'] ?>" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h3>
                                        <a href="<?= 'single.php?post='.$post['id'] ?>"><?= substr($post['title'], 0, 120).'...' ?></a>
                                    </h3>
                                </div>
                                <div class="row">
                                    <div class="d-inline-flex  ">
                                        <p class="text-muted me-4 ">
                                            <i class="bi bi-calendar-event"></i> <?= $post['created_date'] ?>
                                        </p>
                                    </div>
                                    <p><?= mb_substr($post['content'], 0, 155, 'UTF-8').'...' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <div id="posts" class="text-center">
                        <div class="empty-state">
                            <p>Здесь пока ничего нет</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php require_once "app/blocks/pagination.php" ?>
</div>

    <?php require_once "app/blocks/footer.php" ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>


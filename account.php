<?php
define('ROOT_DIR', __DIR__);
include ROOT_DIR . '/app/controllers/topics.php';

$id = $_GET['id'];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$offset = $limit * ($page - 1);

$posts = selectAllPostsByUser('posts', 'users', $id, $limit, $offset);


$total_pages = ceil(countRow('posts', ['id_user' => $id]) / $limit);
$likes=selectAllPostsWithLikes('likes', 'users', $id, $limit, $offset);

$followerCount = countRow('followers', ['author_id' => $id]);
$followingCount = countRow('followers', ['follower_id' => $id]);
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Аккаунт</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
<?php require_once "app/blocks/header.php" ?>
<div class="container">
    <div class=" d-flex mt-3">

        <div class="col-md-4">
            <div class="row me-5">

                <div class="profile-header">
                    <a href="user/edit_profile.php" class="profile-settings-icon">
                        <i class="bi bi-gear"></i>
                    </a>
                    <div class="d-flex flex-column align-items-center">
                        <div class="profile-picture mb-2">
                            <?php
                            $id = $_SESSION['id'];
                            $user = selectOne('users', ['id' => $id]);



                            if (!empty($user['img'])) {
                                $imgUrl = BASE_URL . "/assets/img/users/" . $user['img'];
                            } else {

                                $imgUrl = BASE_URL . "/assets/img/default_avatar.png";
                            }

                            echo '<img src="'.$imgUrl.'" alt="Аватар пользователя" class="profile-avatar">';
                            ?>
                        </div>
                        <h1 class="profile-name"><?php echo htmlspecialchars($user['username']); ?></h1>
                        <?php if (!empty($user['description'])): ?>
                        <p class=""><?php echo htmlspecialchars($user['description']); ?></p>
                        <?php endif; ?>
                        <div class="profile-stats">
                            <div class="d-flex">
                                <div class="text-center me-3">
                                    <a href="followers.php" class="text-decoration-none ">
                                        <div class="fw-bold text-white"><?= $followerCount ?></div>
                                        <div class="text-white">подписчики</div>
                                    </a>
                                </div>
                                <div class="text-center">
                                    <a href="followings.php" class="text-decoration-none text-white">
                                        <div class="fw-bold text-white"><?= $followingCount ?></div>
                                        <div class="text-white">подписки</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-4">
                    <?php require_once ROOT_PATH . "/app/blocks/sidebar.php"; ?>
                </div>
            </div>
        </div>

        <div class="col-md-8">

            <div class="settings-column">
                <h3>Аккаунт</h3>
                <div class="account-info d-flex justify-content-between align-items-center">
                    <?php if (isset($user['username'])): ?>
                        <h3>Что нового, <?php echo htmlspecialchars($_SESSION['username']); ?>?</h3>
                    <?php endif; ?>
                    <a href="user/add_post.php" class="btn btn-primary">Добавить статью</a>
                </div>
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" id="nav-post-tab" data-toggle="tab" href="#myPosts">Мои статьи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-likes-tab" data-toggle="tab" href="#likes">Лайки</a>
                    </li>
                </ul>

            </div>


            <div class="row">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="myPosts" role="tabpanel" aria-labelledby="nav-post-tab">
                        <?php if (!empty($posts)): ?>
                            <?php foreach ($posts as $post): ?>
                                <div class="tab-content">
                                    <div class="post">
                                        <div class="container mb-4 ">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img src="<?= 'assets/img/posts/' . $post['img'] ?>"
                                                         alt="<?= $post['title'] ?>" class="img-fluid">
                                                </div>
                                                <div class="col-md-8 ">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <h3>
                                                            <a href="<?= 'single.php?post=' . $post['id'] ?>"><?= substr($post['title'], 0, 120) . '...' ?></a>
                                                        </h3>
                                                        <div class="dropdown text-end">
                                                            <button class="btn btn-sm btn-light" type="button"
                                                                    id="postOptionsDropdown" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                <i class="bi bi-three-dots"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end"
                                                                aria-labelledby="postOptionsDropdown">
                                                                <li><a class="dropdown-item text-success"
                                                                       href="user/edit_post.php?id=<?= $post['id'] ?>">Редактировать</a>
                                                                </li>
                                                                <li><a class="dropdown-item text-danger"
                                                                       href="user/edit_post.php?del_id=<?= $post['id'] ?>">Удалить</a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                    <div class="row ">
                                                        <div class="d-inline-flex  ">
                                                            <p class="text-muted me-4 ">
                                                                <i class="bi bi-calendar-event"></i> <?= $post['created_date'] ?>
                                                            </p>
                                                        </div>
                                                        <p> <?= mb_substr($post['content'], 0, 155, 'UTF-8') . '...' ?> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <div class="tab-content">
                                <div id="posts" class="text-center">
                                    <div class="empty-state">
                                        <p>Здесь пока ничего нет</p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane fade" id="likes" role="tabpanel" aria-labelledby="nav-likes-tab">
                        <?php if (!empty($likes)): ?>
                            <?php foreach ($likes as $like): ?>
                                <div class="tab-content">
                                    <div class="post">
                                        <div class="container mb-4 ">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img src="<?= 'assets/img/posts/' . $like['img'] ?>"
                                                         alt="<?= $like['title'] ?>" class="img-fluid">
                                                </div>
                                                <div class="col-md-8 ">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <h3>
                                                            <a href="<?= 'single.php?post=' . $like['id'] ?>"><?= substr($like['title'], 0, 120)  ?></a>
                                                        </h3>
                                                        

                                                    </div>
                                                    <div class="row ">
                                                        <div class="d-inline-flex  ">
                                                            <p class="text-muted me-4 ">
                                                                <i class="bi bi-calendar-event"></i> <?= $post['created_date'] ?>
                                                            </p>
                                                            <p class="text-muted">
                                                                <i class="bi bi-person"></i> <?= $post['username'] ?>
                                                            </p>
                                                        </div>
                                                        <p> <?= mb_substr($post['content'], 0, 155, 'UTF-8') . '...' ?> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="tab-content">
                                <div id="posts" class="text-center">
                                    <div class="empty-state">
                                        <p>Здесь пока ничего нет</p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
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


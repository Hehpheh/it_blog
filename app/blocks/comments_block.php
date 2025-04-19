<?php
include_once "app/href.php";
include_once "app/controllers/comments.php";
?>
<div class="col-md-12">
    <h3 class="m-3">Комментарии</h3>
    <?php if (empty($_SESSION['id'])): ?>

        <div class="card mx-4">
            <div class="card-body text-center p-5">
                <h4 class="card-text">Чтобы оставлять комментарии, пожалуйста,
                    <a href="<?= BASE_URL . '/auth.php' ?>" class="text-danger text-decoration-underline">войдите</a>
                    или
                    <a href="<?= BASE_URL . '/reg.php' ?>" class="text-danger text-decoration-underline">зарегистрируйтесь</a>
                </h4>
            </div>
        </div>
    <?php else: ?>

        <div class="card m-4">
            <div class="card-body">
                <form action="<?= BASE_URL . "/single.php?post=" . htmlspecialchars($page) ?>" method="post">
                    <h5 class="card-title">Оставить комментарий</h5>
                    <input type="hidden" name="page" value="<?= htmlspecialchars($page) ?>">

                    <div class="mb-3">
                        <label for="commentText" class="form-label">Комментарий</label>
                        <textarea class="form-control" id="commentText" name="commentText" rows="3" required></textarea>
                    </div>

                    <button name="comment-btn" type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <div class="comment-list">
        <?php if (!empty($commentsAdm)): ?>
            <?php foreach ($commentsAdm as $comment):
                $userComment = selectOne('users', ['id' => $comment['user_id']]); ?>
                <div class="comment mb-3">
                    <div class="card p-3 m-4">
                        <div class="d-inline-flex ">
                            <p class="text-muted me-4">
                                <i class="bi bi-calendar-event"></i> <?= htmlspecialchars($comment['created_date'], ENT_QUOTES, 'UTF-8') ?>
                            </p>
                            <p class="text-muted">
                                <i class="bi bi-person"></i>
                                <?php if ($comment['user_id'] === $_SESSION['id']): ?>
                                    <a class="" href="<?= BASE_URL ."/account.php?id=".$_SESSION['id'] ?>"><?= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') ?></a>
                                <?php else: ?>
                                    <a href="another_user.php?id=<?= $comment['user_id'] ?>"><?= htmlspecialchars($userComment['username'], ENT_QUOTES, 'UTF-8') ?></a>
                                <?php endif; ?>
                            </p>
                        </div>
                        <p class="card-text"><?= htmlspecialchars($comment['commentText'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center p-5">Пока нет комментариев.</p>
        <?php endif; ?>
    </div>
</div>
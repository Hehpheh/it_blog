<?php



$page = $_GET['post'];

$comments = selectAllFromCommentsWithUsers('comments', 'users', $page);


?>

<div class="col-md-12">
    <h3 class="m-3">Комментарии</h3>
    <?php if (empty($_SESSION['id'])): ?>
        <div class="card mx-4">
            <div class="card-body text-center p-5">
                <h4 class="card-text">Чтобы оставлять комментарии, пожалуйста, <a href="<?= BASE_URL . '/auth.php' ?>" class="text-danger text-decoration-underline">войдите</a> или <a href="<?= BASE_URL . '/reg.php' ?>" class="text-danger text-decoration-underline">зарегистрируйтесь</a></h4>
            </div>
        </div>
    <?php else: ?>
        <div class="card m-4">
            <div class="card-body">
                <form id="commentForm">
                    <h5 class="card-title">Оставить комментарий</h5>
                    <input type="hidden" name="page" value="<?= htmlspecialchars($page) ?>">
                    <div class="mb-3">
                        <label for="commentText" class="form-label">Комментарий</label>
                        <textarea class="form-control" id="commentText" name="commentText" rows="3" required></textarea>
                    </div>
                    <button name="comment-btn" id="submitComment" type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <div class="comment-list" id="commentList">
        <?php foreach ($comments as $comment): ?>
            <div class="comment mb-3">
                <div class="card p-3 m-4">
                    <div class="d-inline-flex">
                        <p class="text-muted me-4"><i class="bi bi-calendar-event me-1 "></i><?= htmlspecialchars($comment['created_date']) ?></p>
                        <p class="text-muted"><i class="bi bi-person me-1"></i><?= htmlspecialchars($comment['username']) ?></p>
                    </div>
                    <p class="card-text"><?= htmlspecialchars($comment['commentText']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="main.js"></script>
<div class="sidebar">
    <!-- Поиск -->
    <div class="search-section container-p-0">
        <form class="d-flex" role="search" method="post" action="search.php">
            <div class="input-group">
                <input name="search-text" class="form-control" type="search" placeholder="Поиск" aria-label="Поиск">
                <button name="search-btn" class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Категории -->
    <div class="container-topics mt-3 p-3 categories">
        <h4 class="categories-title ms-2">Категории</h4>
        <ul class="categories-list">
            <?php foreach ($topics as $key => $topic): ?>
                <li class="category-item">
                    <a href="categories_page.php?id=<?php echo $topic['id']; ?>"
                       class=""><?php echo $topic['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Топ постов -->
    <?php
    global $pdo;

    $sql = "SELECT posts.id, posts.title, COUNT(likes.id) AS like_count
        FROM posts
        INNER JOIN likes ON posts.id = likes.id_post
        WHERE likes.created_date >= DATE(NOW()) - INTERVAL 7 DAY
        GROUP BY posts.id
        HAVING
        like_count > 0
        ORDER BY like_count DESC
        LIMIT 5
        ";

    $query = $pdo->prepare($sql);
    $query->execute();
    $topPosts = $query->fetchAll();

    if (empty($topPosts)) {
        // Если нет лайков за последнюю неделю, выбираем 5 случайных статей
        $sql = "SELECT id, title FROM posts ORDER BY RAND() LIMIT 5";
        $query = $pdo->prepare($sql);
        $query->execute();
        $topPosts = $query->fetchAll();
    }

    // Теперь у вас в $topPosts либо топ 5 постов с лайками за неделю, либо 5 случайных постов
    ?>
    <div class="container-fluid mt-3 py-3 popular-posts">
        <h4 class="popular-posts-title ms-2">Топ постов за неделю</h4>
        <ul class="popular-posts-list">
            <?php if (!empty($topPosts)): ?>
                <?php $i = 1; foreach ($topPosts as $post): ?>
                    <li class="popular-posts-item">
                        <a class="popular-posts-link d-flex align-items-center" href="single.php?post=<?= $post['id'] ?>">
                            <strong><?= $i++ ?></strong> <?= htmlspecialchars($post['title']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="popular-posts-item">
                    Пока нет постов.
                </li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Блок шуток -->
    <?php
    $jokes = selectAll('jokes');
    if (!empty($jokes)) {
        $randomIndex = array_rand($jokes);
        $randomJoke = $jokes[$randomIndex];
        $jokeText = html_entity_decode($randomJoke['text']);

        echo '<div class="container-fluid mt-3 py-3 joke-section rounded shadow-sm">';
        echo '<h4 class="joke-title ms-2 text-center">Шутка <i class="bi bi-emoji-laughing"></i></h4>';
        echo '<p class="joke-text ms-2">' . htmlspecialchars($jokeText) . '</p>';
        echo '</div>';
    }
    ?>
</div>
<div class="sidebar">
    <div class="search-section container-p-0">
        <form class="d-flex" role="search" method="post" action="search.php">
            <div class="input-group">
                <input name="search-text" class="form-control" type="search" placeholder="Поиск" aria-label="Поиск">
                <button name="search-btn" class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> <!-- Bootstrap Icons для лупы -->
                </button>
            </div>
        </form>
    </div>
    <div class="container-topics mt-3 p-3 categories">
        <h4 class="categories-title ms-2">Категории</h4>
        <ul class="categories-list">
            <?php foreach ($topics as $key => $topic): ?>
                <li class="category-item">
                    <a href="categories_page.php?id=<?php echo $topic['id']; ?>" class=""><?php echo $topic['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="container-fluid mt-3 py-3 popular-posts">
        <h4 class="popular-posts-title ms-2">Топ постов</h4>
        <ul class="popular-posts-list ">
            <?php for ($i = 1; $i < 6; $i++): ?>
                <li class="popular-posts-item">
                    <a class="popular-posts-link d-flex align-items-center">
                        <strong><?= $i ?></strong> Название статьи
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
</div>
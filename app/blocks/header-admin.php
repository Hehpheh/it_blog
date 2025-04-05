<?php
include "app/href.php";
?>
<header class="container-fluid">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-2 col-md-2">
                <h1>
                    <a href="<?= BASE_URL . "/index.php"; ?>">logo</a>
                </h1>
            </div>
            <nav class="col-9 col-md-7">
                <ul class="navbar-nav d-flex flex-row justify-content-start">
                    <li class="nav-item me-3"><a class="" href="<?= BASE_URL . "/index.php"; ?>">Главная</a></li>


                    <?php if (isset($_SESSION['id']) && $_SESSION['admin']): ?>
                        <li class="nav-item me-3"><a class="" href="<?= BASE_URL . "/admin/posts/index.php" ?>">Админ панель</a></li>
                    <?php endif; ?>

                </ul>
            </nav>
            <div class="col-1 ">
                <?php if (isset($_SESSION['id'])): ?>
                    <a class="btn btn-outline-primary" href="<?= BASE_URL . "/logout.php"; ?>">Выход</a>
                <?php else: ?>
                    <a class="btn btn-outline-primary" href="<?= BASE_URL . "/auth.php"; ?>">Войти</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
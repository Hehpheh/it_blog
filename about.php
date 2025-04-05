<?php
define('ROOT_DIR', __DIR__);
include ROOT_DIR . '/app/controllers/topics.php';
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>О нас</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>
<body>
<?php require_once "app/blocks/header.php" ?>
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="  flex-column justify-content-center align-items-center">
            <h1 class="text-center"><strong>О нас</strong></h1>
            <p class=" mission-description secondary text-center">
                Мы верим, что технологии могут изменить мир к лучшему, и стремимся помочь вам раскрыть их потенциал.
            </p>
        </div>

    </div>
</div>





<div class="container " style="min-height: 70vh;">
    <div class="main-content my-5">
        <div class="row">
            <h2 class="text-center"><strong>Что мы предлагаем</strong></h2>
            <div class="col-md-6">
                <div class="about_us-card">
                    <div class="about_us-icon p-2">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="about_us-card-title"><strong>Сообщество и обмен</strong></h3>
                    <p class="about_us-card-text">Делитесь знаниями, публикуйте статьи, станьте частью нашего активного
                        сообщества.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about_us-card">
                    <div class="about_us-icon p-2">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <h3 class="about_us-card-title"><strong>Тренды и технологии</strong></h3>
                    <p class="about_us-card-text">Будьте в курсе новостей, изучайте последние тренды и технологические
                        достижения.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about_us-card">
                    <div class="about_us-icon p-2">
                        <i class="bi bi-gear"></i>
                    </div>
                    <h3 class="about_us-card-title"><strong>Инструменты и решения</strong></h3>
                    <p class="about_us-card-text">Находите полезные инструменты и практичные решения для эффективного
                        решения ваших задач.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about_us-card">
                    <div class="about_us-icon p-2">
                        <i class="bi bi-lightbulb"></i>
                    </div>
                    <h3 class="about_us-card-title"><strong>Вдохновение и рост</strong></h3>
                    <p class="about_us-card-text">Ищите вдохновение, развивайте навыки и достигайте новых высот с нашей
                        платформой.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="faq-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
            <h2 class="my-4"><strong>FAQ</strong></h2>
            <div class="accordion accordion-flush mb-5" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                            Какого типа статьи вы предлагаете?
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                         data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Мы предлагаем разнообразные статьи, охватывающие различные языки программирования,
                            фреймворки, лучшие практики и тенденции отрасли, чтобы помочь вам быть в курсе событий.
                        </div>
                    </div>
                </div>
                <hr>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                aria-controls="flush-collapseTwo">
                            Могу ли я написать статью на сайт?
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                         data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Да, мы приветствуем вклад опытных специалистов.
                        </div>
                    </div>
                </div>
                <hr>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">
                            Есть ли какие-то требования к публикуемым статья?
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                         data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Все статьи должны быть уникальными, информативными, хорошо структурированными и
                            соответствовать тематике нашего сайта. Мы также приветствуем использование примеров кода и иллюстраций.
                        </div>
                    </div>
                </div>
                <hr>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseFour" aria-expanded="false"
                                aria-controls="flush-collapseFour">
                            Как я могу связаться с вами для сотрудничества или предложений?
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                         data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Вы можете связаться с нами через форму обратной связи на странице "Контакты".
                        </div>
                    </div>
                </div>
                <hr>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseFive" aria-expanded="false"
                                aria-controls="flush-collapseFive">
                            Можно ли комментировать статьи?
                        </button>
                    </h2>
                    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive"
                         data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Да, у каждого пользователя есть возможность оставить комментарий к статье,
                            высказав свое мнение или задав вопрос.
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="main-content my-5">
    <div class="row justify-content-center p-5">
        <div class="col-md-6">
            <h1 class="title"><strong>Откройте будущее технологий</strong></h1>
            <p class="subtitle text-center">Погружайтесь в среду, чтобы улучшить свои знания в сфере it. Следите за последними
                тенденциями в отрасли прямо здесь.</p>
            <div class="d-flex justify-content-center m-4"> <a href="index.php" class="btn btn-primary ">Читать статьи</a></div>

        </div>
    </div>
</div>
</div>

<?php require_once "app/blocks/footer.php" ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

</body>
</html>
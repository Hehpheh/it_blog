<?php
define('ROOT_DIR', __DIR__);
include ROOT_DIR . '/app/controllers/topics.php';
include ROOT_DIR . '/app/controllers/contact_form_messages.php';
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Контакты</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>
<body>
<?php require_once "app/blocks/header.php" ?>

<div class="row justify-content-center">
    <div class="col-md-7 my-5">
        <h1 class="text-center"><strong>Контакты</strong></h1>
    </div>
</div>

<div class="contact-form">
    <div class="row justify-content-center">
    <div class=" col-md-7 my-5">
        <div class="row container">
            <h2><strong>Есть вопросы?</strong></h2>
            <p>Свяжитесь с нами, используя форму ниже:</p>

            <div class="">
                <form id="contactForm" method="post" action="contacts.php">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Имя:</label>
                                <input type="text" class="form-control" id="name" name="name" required value="<?=$name?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required value="<?=$email?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="message">Сообщение:</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required><?=$message?></textarea>
                    </div>
                    <!-- Проверка на наличие ошибок -->
                    <?php if (!empty($errMsg)): ?>
                        <?php if (is_array($errMsg)): ?>
                            <?php foreach ($errMsg as $error): ?>
                                <div class="alert alert-danger text-center" >
                                    <?= $error ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-danger text-center" >
                                <?= $errMsg ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- Проверка на наличие сообщения об успехе -->
                    <?php if ($successMsg): ?>
                        <div class="alert alert-success mt-4">
                            <?= htmlspecialchars($successMsg) ?>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn  btn-outline-light mt-3" name="button_name" value="Отправить">Отправить</button>
                </form>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
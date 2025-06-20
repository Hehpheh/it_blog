<?php include "app/controllers/contact_form_messages.php";
include "app/href.php";?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Обратная связь</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
<?php require_once "app/blocks/header-admin.php" ?>

<!--main  content-->
<div class="container-fluid admin-panel">
    <div class="row">
        <?php require_once "app/blocks/sidebar-admin.php" ?>

        <div class="messages col-md-8 m-3">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center m-3">Управление обратной связью</h2>
                    <div class="card-header row">
                        <div class="col-1">ID</div>
                        <div class="col-2">Имя</div>
                        <div class="col-3">Email</div>
                        <div class="col-3">Текст сообщения</div>
                        <div class="col-3">Управление</div>
                    </div>

                    <?php foreach ($messages as $key => $message): ?>
                        <div class="row message p-3 border-bottom">
                            <div class="col-1"><?php echo $message['id']; ?></div>
                            <div class="col-2"><?php echo $message['name']; ?></div>
                            <div class="col-3"><?php echo htmlspecialchars($message['email'], ENT_QUOTES, 'UTF-8'); ?></div> <!-- Уменьшено с col-3 до col-2 -->
                            <div class="col-3">
                                <?php
                                $messageText = htmlspecialchars($message['message'], ENT_QUOTES, 'UTF-8');
                                echo $messageText;
                                ?>
                            </div>
                            <div class="col-3">
                                <a class="text-danger" href="index.php?del_id=<?php echo $message['id']; ?>">Удалить</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
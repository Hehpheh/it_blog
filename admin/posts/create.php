<?php
include "app/href.php";
include "app/controllers/posts.php";
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,usermeta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Создание Статьи</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- подключаем редактор CKEditor5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
</head>
<body>
<?php require_once "app/blocks/header-admin.php" ?>
<div class="container-fluid admin-panel">
    <div class="row">
        <?php require_once "app/blocks/sidebar-admin.php" ?>
        <div class="posts col-md-8 m-3">
            <div class="card">
                <div class="card-body add-post">
                    <div class="button row m-3">
                        <a href="index.php" class="col-3 btn btn-warning">Управление постами</a>
                    </div>
                    <h2 class="text-center">Создание Статьи</h2>

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

                    <form action="create.php" method="post" enctype="multipart/form-data" id="create-post-form">
                        <div class="mb-3">
                            <input value="<?=$title;?>" type="text" class="form-control" id="title" name="title" placeholder="Введите заголовок">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Контент:</label>
                            <textarea id="editor" name="content" style="height:300px;"><?php echo htmlspecialchars($content, ENT_QUOTES, 'UTF-8');?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Изображение:</label>
                            <input name="img" type="file" class="form-control" id="inputGroupFile02">
                        </div>
                        <div class="mb-3">
                            <label for="topic" class="form-label">Категория:</label>
                            <select class="form-select" name="topic">
                                <?php foreach ($topics as $key => $topic): ?>
                                    <option value="<?=$topic['id'];?>"><?=$topic['name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Статус:</label>
                            <div class="form-check">
                                <input name="publish_status" value="1" class="form-check-input" type="checkbox" id="published" checked>
                                <label class="form-check-label" for="published">Опубликовать</label>
                            </div>
                        </div>
                        <button name="add-posts" type="submit" class="btn btn-primary">Создать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
</body>
</html>
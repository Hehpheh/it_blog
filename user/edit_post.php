<?php
include "app/href.php";
include "app/controllers/posts.php";
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактирование Статьи</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!--подключаем редактор CKEditor 5-->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

</head>
<body>

<?php require_once "app/blocks/header.php" ?>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 m-3">
            <div class="card">
                <div class="card-body add-post">
                    <h2 class="text-center">Редактирование Статьи</h2>
                    <div class="mb-3 p-3 err">
                        <?= $errMsg ?>
                    </div>
                    <form action="edit_post.php" method="post" enctype="multipart/form-data" id="create-post-form">
                        <input type="hidden" name="id" value="<?=$id; ?>">
                        <div class="mb-3">
                            <input value="<?=$title; ?>" type="text" class="form-control" id="title" name="title" placeholder="Введите заголовок" >
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Контент:</label>
                            <textarea id="editor" name="content" style="height:300px;"><?php echo htmlspecialchars($content, ENT_QUOTES, 'UTF-8'); ?></textarea>
                        </div>


                        <div class="mb-3">
                            <label for="img" class="form-label">Изображение:</label>

                            <input name="img" type="file" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="topic" class="form-label">Категория:</label>
                            <select class="form-select" name="topic">
                                <?php foreach ($topics as $key => $topic_item): ?>
                                    <option value="<?=$topic_item['id']?>" <?php if ($topic_item['id'] == $topic) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($topic_item['name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Статус:</label>
                            <div class="form-check">
                                <?php if(empty($status) || $status==0): ?>
                                    <input name="publish_status" value="1" class="form-check-input" type="checkbox" id="published" >
                                    <label class="form-check-label" for="published">
                                        Не опубликовано
                                    </label>
                                <?php else: ?>
                                    <input name="publish_status" value="1" class="form-check-input" type="checkbox" id="published" checked>
                                    <label class="form-check-label" for="published">
                                        Опубликовано
                                    </label>
                                <?php endif; ?>
                            </div>
                        </div>



                        <button name="edit-post" type="submit" class="btn btn-primary">Изменить</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "app/blocks/footer.php" ?>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
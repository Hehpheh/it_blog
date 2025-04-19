<?php

include_once "app/database/db.php";
include_once "app/href.php";

$errMsg = '';
$id = '';
$title = '';
$content = '';
$img = '';
$topic = '';
$status = '';

$topics = selectAll('topics');
$posts = selectAll('posts');
$postsAdm = selectAllFromPostsWithUsers('posts', 'users');

// Создание поста
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["add-posts"])) {

    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS));
    $content = trim($_POST['content']);
    $topic = trim(filter_var($_POST['topic'], FILTER_SANITIZE_SPECIAL_CHARS));
    $status = isset($_POST['publish_status']) ? 1 : 0;


    if (empty($title)) {
        $errMsg = "Заполни название";
    }

    if (empty($errMsg)) {
        if (empty($_FILES['img']['name'])) {
            $errMsg = "Загрузите изображение";
        } else {
            $imgName = $_FILES['img']['name'];
            $fileTmpName = $_FILES['img']['tmp_name'];
            $fileType = $_FILES['img']['type'];
            $destination = ROOT_PATH . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "posts" . DIRECTORY_SEPARATOR . $imgName;

            if (strpos($fileType, 'image') === false) {
                $errMsg = "Подгружаемый файл не является изображением!";
            } else {
                $result = move_uploaded_file($fileTmpName, $destination);

                if ($result) {
                    $_POST['img'] = $imgName;
                } else {
                    $errMsg = "Ошибка загрузки изображения на сервер";
                }
            }
        }

        if (empty($errMsg)) {
            $post = [
                'id_user' => $_SESSION['id'],
                'title' => $title,
                'content' => $content,
                'img' => $_POST['img'],
                'status' => $status,
                'topic_id' => $topic
            ];

            $id = insert('posts', $post);
            $post = selectOne('posts', ['id' => $id]);

            if($_SESSION['admin']){
                header('location:' . BASE_URL . '/admin/posts/index.php');
            }
            else{
                header('location:' . BASE_URL . '/account.php?id='.$_SESSION['id']);
            }

            exit();
        }
    }
} else {
    $id = '';
    $title = '';
    $content = '';
    $status = '';
    $topic = '';
}
//Редактирование поста
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $post = selectOne('posts', ['id' => $_GET['id']]);
    $id =  $post['id'];
    $title =  $post['title'];
    $content = $post['content'];
    $topic = $post['topic_id'];
    $status = $post['status'];
     $img = $post['img'];


}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["edit-post"])) {
    $id = $_POST['id'];
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS));
    $content = trim($_POST['content']);
    $topic = trim(filter_var($_POST['topic'], FILTER_SANITIZE_NUMBER_INT));
    $status = isset($_POST['publish_status']) ? 1 : 0;

    $currentPost = selectOne('posts', ['id' => $id]);
    $existingImg = $currentPost['img'];

    if (!empty($_FILES['img']['name'])) {
        $imgName = $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "posts" . DIRECTORY_SEPARATOR . $imgName;

        if (strpos($fileType, 'image') === false) {
            $errMsg = "Подгружаемый файл не является изображением!";
        } else {
            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result) {
                $imgToSave = $imgName; // Use the new image name
            } else {
                $errMsg = "Ошибка загрузки изображения на сервер";
            }
        }
    } else {
        $imgToSave = $existingImg;
    }

    if (empty($title)) {
        $errMsg = "Заполни название";
    } else {
        $post = [
            'title' => $title,
            'content' => $content,
            'img' => $imgToSave,
            'topic_id' => $topic,
            'status' => $status
        ];

        update('posts', $post, $id);
        if ($_SESSION['admin']) {
            header('location:' . BASE_URL . '/admin/posts/index.php');
        } else {
            header('location:' . BASE_URL ."/account.php?id=".$_SESSION['id']);
        }
        exit();
    }
}

//удаление поста
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["del_id"])) {
    $id = $_GET['del_id'];
    delete('posts',$id);
    if($_SESSION['admin']){
        header('location:' . BASE_URL . '/admin/posts/index.php');
        exit();
    }
    else{
        header('location:' . BASE_URL . '/account.php?id='.$_SESSION['id']);
        exit();
    }

}


// Статус опубликовать или снять с публикации
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
    $id = $_GET['pub_id'];
    $status = $_GET['status'];

    $postId = update('posts', ['status' => $status],$id );

    header('location: ' . BASE_URL . '/admin/posts/index.php');
    exit();
}
// Like
$isLiked = false;
<?php
include_once "app/database/db.php";
include_once "app/href.php";

$page = $_GET['post'];
$commentsAdm=selectAll('comments',['status'=>1]);
$username = '';
$commentText = '';
$status = 1; //комментарий опубликован
$errMsg = '';
$comments = [];

// Создание комментария
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["comment-btn"])) {
    $commentText = trim(filter_var($_POST['commentText'], FILTER_SANITIZE_SPECIAL_CHARS));

    if (empty($commentText)) {
        $errMsg = "Нельзя отправить пустой отзыв!";
    }

    if (empty($errMsg)) {
        $comment = [
            'user_id' => $_SESSION['id'],
            'status' => 1,
            'page' => $page,
            'commentText' => $commentText
        ];

        insert('comments', $comment);
        $commentText = '';

        $comments = selectAllFromCommentsWithUsers('comments','users',$page);

        header('location:' . BASE_URL . '/single.php?post=' . $page);
        exit();
    }
}

// удалить комментарий
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["del_id"])) {
    $id = $_GET['del_id'];
    delete('comments',$id);
    header('location: ' . BASE_URL . '/admin/comments/index.php');
}


// Статус опубликовать или снять с публикации комментарий
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    $status = $_GET['status'];

    $postId = update('comments', ['status' => $status], $id);

    header('location: ' . BASE_URL . '/admin/comments/index.php');
    exit();
}
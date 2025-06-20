<?php

include_once "app/database/db.php";
include_once "app/href.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commentText'])) {
    $page = $_GET['post'];


    $commentText = trim(filter_var($_POST['commentText'], FILTER_SANITIZE_SPECIAL_CHARS));


    // Создание комментария
    $comment = [
        'user_id' => $_SESSION['id'],
        'status' => 1,
        'page' => $page,
        'commentText' => $commentText
    ];


    $id = insert('comments', $comment);

    if ($id) {

        $comments = selectAllFromCommentsWithUsers('comments', 'users', $page);


        echo json_encode(['success' => true, 'comments' => $comments]);
        exit;
    } else {

        echo json_encode(['success' => false, 'message' => 'Ошибка при добавлении комментария.']);
        exit;
    }
}

// удалить комментарий
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["del_id"])) {
    $id = $_GET['del_id'];
    delete('comments', $id);
    header('location: ' . BASE_URL . '/admin/comments/index.php');
    exit();
}


// Статус опубликовать или снять с публикации комментарий
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    $status = $_GET['status'];

    update('comments', ['status' => $status], $id);

    header('location: ' . BASE_URL . '/admin/comments/index.php');
    exit();
}

<?php

include_once "app/href.php";
require_once 'app/database/db.php';



$follower_id = $_SESSION['id'];
$author_id = isset($_POST['authorid']) ? filter_var($_POST['authorid'], FILTER_VALIDATE_INT) : null;

if ($author_id === null || $author_id === false) {
    echo json_encode(['success' => false, 'message' => 'Неверный ID пользователя.']);
    exit;
}


if ($follower_id === $author_id) {
    echo json_encode(['success' => false, 'message' => 'Вы не можете подписаться на самого себя.']);
    exit;
}


$existing_follow = selectOne('followers', ['follower_id' => $follower_id, 'author_id' => $author_id]);

if ($existing_follow) {

    delete('followers', $existing_follow['id']);
    $is_following = false;
} else {

    $follow_data = [
        'follower_id' => $follower_id,
        'author_id' => $author_id
    ];
    insert('followers', $follow_data);
    $is_following = true;
}



echo json_encode(['success' => true, 'is_following' => $is_following]);
exit;
?>
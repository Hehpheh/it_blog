<?php

include_once "app/href.php";
require_once 'app/database/db.php';


$userId = $_SESSION['id'];
$postId = isset($_POST['id_post']) ? filter_var($_POST['id_post'], FILTER_VALIDATE_INT) : null;

if ($postId === null || $postId === false) {
    echo json_encode(['success' => false, 'message' => 'Неверный ID поста.']);
    exit;
}


$existingLikes = selectAll('likes', ['id_user' => $userId, 'id_post' => $postId]);

if (!empty($existingLikes)) {

    delete('likes', $existingLikes[0]['id']);
    $liked = false;
} else {

    $likeData = [
        'id_user' => $userId,
        'id_post' => $postId
    ];
    $id = insert('likes', $likeData);
    $liked = true;
}


$likes_count = count(selectAll('likes', ['id_post' => $postId]));

echo json_encode(['success' => true, 'liked' => $liked, 'likes_count' => $likes_count]);

exit;

<?php

include_once "app/href.php";
require_once 'app/database/db.php';



$follower_id = $_SESSION['id']; // ID текущего пользователя (подписчик)
$author_id = isset($_POST['authorid']) ? filter_var($_POST['authorid'], FILTER_VALIDATE_INT) : null; // ID пользователя, на которого подписываются

if ($author_id === null || $author_id === false) {
    echo json_encode(['success' => false, 'message' => 'Неверный ID пользователя.']);
    exit;
}

// Проверяем, пытается ли пользователь подписаться на себя
if ($follower_id === $author_id) {
    echo json_encode(['success' => false, 'message' => 'Вы не можете подписаться на самого себя.']);
    exit;
}

// Проверяем, подписан ли пользователь уже
$existing_follow = selectOne('followers', ['follower_id' => $follower_id, 'author_id' => $author_id]);

if ($existing_follow) {
    // Пользователь уже подписан - отписываем его
    delete('followers', $existing_follow['id']);
    $is_following = false;
} else {
    // Пользователь не подписан - подписываем его
    $follow_data = [
        'follower_id' => $follower_id,
        'author_id' => $author_id
    ];
    insert('followers', $follow_data);
    $is_following = true;
}

//  Не нужно получать количество подписок (как с лайками)

echo json_encode(['success' => true, 'is_following' => $is_following]);
exit;
?>
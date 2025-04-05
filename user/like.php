<?php


include "app/href.php";
include 'app/controllers/user_acc.php';


// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Вы должны быть авторизованы, чтобы ставить лайки.']);
    exit;
}

// Получаем данные из POST-запроса
$postId = isset($_POST['id_post']) ? filter_var($_POST['id_post'], FILTER_VALIDATE_INT) : null;

// Проверяем, что ID поста получен и является целым числом
if ($postId === null || $postId === false) {
    echo json_encode(['success' => false, 'message' => 'Неверный ID поста.']);
    exit;
}

$userId = $_SESSION['id'];

// Проверяем, ставил ли пользователь уже лайк этому посту
$sql_select = "SELECT * FROM likes WHERE id_user = ? AND id_post = ?";
$stmt = $pdo->prepare($sql_select);
$stmt->execute([$userId, $postId]);

if ($stmt->rowCount() > 0) {
    // Пользователь уже ставил лайк - удаляем его (дизлайк)
    $sql_delete = "DELETE FROM likes WHERE id_user = ? AND id_post = ?";
    $stmt = $pdo->prepare($sql_delete);
    $result = $stmt->execute([$userId, $postId]);

    if ($result) {
        echo json_encode(['success' => true, 'liked' => false]); // Лайк удален
    } else {
        echo json_encode(['success' => false, 'message' => 'Ошибка при удалении лайка.']);
    }
} else {
    // Пользователь еще не ставил лайк - добавляем его
    $sql_insert = "INSERT INTO likes (id_user, id_post) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql_insert);
    $result = $stmt->execute([$userId, $postId]);

    if ($result) {
        echo json_encode(['success' => true, 'liked' => true]); // Лайк добавлен
    } else {
        echo json_encode(['success' => false, 'message' => 'Ошибка при добавлении лайка.']);
    }
}

exit;
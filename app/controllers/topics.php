<?php
include_once "app/database/db.php";
include_once "app/href.php";

$errMsg = []; // Инициализируем $errMsg как массив
$id = '';
$name = '';
$topics = selectAll('topics');

// Создание категории
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["topic-creat"])) {
    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));

    if (strlen($name) < 3) {
        $errMsg['name'] = "Категория должна быть длиннее!";
    } else {
        $existence = selectOne('topics', ['name' => $name]);

        if ($existence && $existence['name'] === $name) {
            $errMsg['name'] = "Такая категория уже есть!";
        } else {
            $topic = ['name' => $name,];
            $id = insert('topics', $topic);
            $topic = selectOne('topics', ['id' => $id]);
            header('location:' . BASE_URL . '/admin/topics/index.php');
            exit();
        }
    }
} else {
    $name = '';
}

// Редактирование категории
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["id"])) {
    $id = $_GET['id'];
    $topic = selectOne('topics', ['id' => $id]);
    if($topic){
        $id = $topic['id'];
        $name = $topic['name'];
    } else {
        $errMsg['global'] = "Категория не найдена!";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["topic-edit"])) {
    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
    $id = $_POST['id'];

    if (strlen($name) < 3) {
        $errMsg['name'] = "Категория должна быть длиннее!";
    } else {
        $topic = ['name' => $name,];
        update('topics', $topic, $id);
        header('location:' . BASE_URL . '/admin/topics/index.php');
        exit();
    }
}

// Удаление категории
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["del_id"])) {
    $id = $_GET['del_id'];
    delete('topics', $id);
    header('location:' . BASE_URL . '/admin/topics/index.php');
    exit();
}
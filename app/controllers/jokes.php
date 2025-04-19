<?php

include_once "app/database/db.php";
include_once "app/href.php";

$errMsg = '';
$id='';
$text='';
$jokes = selectAll('jokes');

// Создание шутки
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["joke-creat"])) {
    $text = trim(filter_var($_POST['text'], FILTER_SANITIZE_SPECIAL_CHARS));

    if (strlen($text) < 10) {
        $errMsg = "Шутка должна быть длиннее";
    } else {
        $existence = selectOne('jokes', ['text' => $text]);
        if ($existence && $existence['text'] === $text) {
            $errMsg = "Такая шутка уже есть!";
        } else {
            $joke = [
                'text' => $text,
            ];
            $id = insert('jokes', $joke);
            $joke = selectOne('jokes', ['id' => $id]);
            header('location: ' . BASE_URL . '/admin/jokes/index.php');
            exit();
        }
    }
} else {
    $text = '';
}

//Редактирование шутки
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["id"])) {

    $id = $_GET['id'];
    $joke = selectOne('jokes', ['id' => $id]);
    $id=$joke['id'];
    $text = $joke['text'];

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["joke-edit"])) {

    $text = trim(filter_var($_POST['text'], FILTER_SANITIZE_SPECIAL_CHARS));
    $id = $_POST['id'];

    if (strlen($text) < 10) {
        $errMsg = "Шутка должна быть длиннее!";
    } else {
        $joke = [
            'text' => $text,
        ];
        update('jokes',$joke,$id);
        header('location: ' . BASE_URL . '/admin/jokes/index.php');
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["del_id"])) {
    $id = $_GET['del_id'];
    delete('jokes',$id);
    header('location: ' . BASE_URL . '/admin/jokes/index.php');
}

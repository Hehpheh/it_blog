<?php

include_once "app/database/db.php";
include_once "app/href.php";


$messages = selectAll('contact_form_messages');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    delete('contact_form_messages', $id);
    header('location: ' . BASE_URL . '/contact_form/index.php');
    exit();
}


$errMsg = []; // Инициализируем $errMsg как массив
$name = '';
$email = '';
$message = '';
$successMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button_name'])) {
    // Получаем данные из формы
    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $message = trim(filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS));

    if (empty($name)) {
        $errMsg['name'] = "Пожалуйста, введите ваше имя.";
    }
    if (empty($email)) {
        $errMsg['email'] = "Пожалуйста, введите ваш email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errMsg['email'] = "Пожалуйста, введите корректный email.";
    }
    if (empty($message)) {
        $errMsg['message'] = "Пожалуйста, введите ваше сообщение.";
    }


    if (empty($errMsg)) {
        $contact_form_message = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ];

        $id = insert('contact_form_messages', $contact_form_message);
        if ($id) {
            $successMsg = 'Ваше сообщение успешно отправлено!';
            $name = '';  //очистка полей формы
            $email= '';
            $message = '';

        } else {
            $errMsg['db'] = "Ошибка при добавлении сообщения в базу данных.";
        }
    }
}
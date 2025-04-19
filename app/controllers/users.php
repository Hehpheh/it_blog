<?php

include "app/database/db.php";
include "app/href.php";



$errMsg = [];

function loginUser($user)
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    if ($_SESSION['admin']) {
        header('Location:' . BASE_URL . '/admin/posts/index.php');
        exit();
    } else {
        header('Location:' . BASE_URL . '/index.php');
        exit();
    }
}

// Обработка формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
    $admin = 0;
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password_confirm = trim(filter_var($_POST['password_confirm'], FILTER_SANITIZE_SPECIAL_CHARS));

    if (empty($username) || empty($email) || empty($password)) {
        $errMsg['reg'] = 'Заполни все поля!';
    } elseif (strlen($username) < 2) {
        $errMsg['username'] = 'Логин должен быть длиннее двух символов';
    } elseif ($password !== $password_confirm) {
        $errMsg['password'] = 'Пароли не совпадают';
    } else {
        $existence = selectOne('users', ['email' => $email]);
        if ($existence && $email === $existence['email']) {
            $errMsg['email'] = 'Пользователь с таким email уже есть!';
        } else {
            $pass = password_hash($password_confirm, PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $username,
                'email' => $email,
                'password' => $pass,
            ];
            $id = insert('users', $post);
            $user = selectOne('users', ['id' => $id]);
            loginUser($user);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $username = '';
    $email = '';
}

// Обработка формы авторизации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-auth'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
    $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_SPECIAL_CHARS));

    if (empty($email) || empty($pass)) {
        $errMsg['auth'] = 'Заполни все поля!';
    } else {
        $existence = selectOne('users', ['email' => $email]);

        if (!$existence || $email !== $existence['email']) {
            $errMsg['email'] = 'Пользователь с таким email не найден!';
        } elseif (!password_verify($pass, $existence['password'])) {
            $errMsg['password'] = 'Неправильный пароль!';
        } else {
            loginUser($existence);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $email = '';
}

$id = '';
$username = '';
$email = '';
$role = '';
$password = '';
$password_confirm = '';
$users = selectAll('users');


// Добавление пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-create'])) {
    $errMsg = []; // Инициализируем $errMsg как массив
    $admin = 0;
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password_confirm = trim(filter_var($_POST['password_confirm'], FILTER_SANITIZE_SPECIAL_CHARS));
    $role = ($_POST['role'] === 'admin') ? 1 : 0;

    if (empty($username) || empty($email) || empty($password)) {
        $errMsg['create'] = 'Заполни все поля!';
    } elseif (strlen($username) < 2) {
        $errMsg['username'] = 'Логин должен быть длиннее двух символов';
    } elseif ($password !== $password_confirm) {
        $errMsg['password'] = 'Пароли не совпадают';
    } else {
        $existence = selectOne('users', ['email' => $email]);
        if ($existence && $email === $existence['email']) {
            $errMsg['email'] = 'Пользователь с таким email уже есть!';
        } else {
            $pass = password_hash($password_confirm, PASSWORD_DEFAULT);
            $post = [
                'admin' => $role,
                'username' => $username,
                'email' => $email,
                'password' => $pass,
            ];
            $id = insert('users', $post);
            $user = selectOne('users', ['id' => $id]);
            header('location:' . BASE_URL . '/admin/users/index.php');
            exit();
        }
    }
} else {
    $username = '';
    $email = '';
    $role = '';
    $password = '';
    $password_confirm = '';
}

// Редактирование пользователя
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $errMsg = []; // Инициализировать $errMsg для редактирования
    $user = selectOne('users', ['id' => $_GET['id']]);
    if ($user) {
        $id = $user['id'];
        $admin = $user['admin'];
        $username = $user['username'];
        $email = $user['email'];
    }else{
        $errMsg['global'] = 'Пользователь не найден';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-edit"])) {
    $errMsg = []; // Инициализировать $errMsg для редактирования
    $id = $_POST['id'];
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $role = $_POST['role'];

    if (empty($username) || empty($email)) {
        $errMsg['edit'] = 'Заполни все поля!';
    } else {
        $existence = selectOne('users', ['email' => $email]);

        //Проверяем если email уже занят, и это не текущий пользователь
        if ($existence && $email === $existence['email'] && $existence['id'] !== $id) {
            $errMsg['email'] = 'Пользователь с таким email уже есть!';
        } else {
            $user = [
                'username' => $username,
                'email' => $email,
                'admin' => $role === 'admin' ? 1 : 0,
            ];
            update('users', $user, $id);
            header('location:' . BASE_URL . '/admin/users/index.php');
            exit();
        }
    }
}

// Удаление пользователя
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["del_id"])) {
    delete('users', $_GET["del_id"]);
    header('location:' . BASE_URL . '/admin/users/index.php');
    exit();
}
<?php

include "app/database/db.php";
include "app/href.php";

$errMsg='';
function loginUser($user){
    $_SESSION['id']=$user['id'];
    $_SESSION['username']=$user['username'];
    $_SESSION['admin']=$user['admin'];

    if ($_SESSION['admin']){
        header('Location: ' .BASE_URL . '/admin/posts/index.php');
    }
    else{
        header('Location: ' .BASE_URL . '/index.php');
    }
}

//Обработка формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
    $admin = 0;
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password_confirm=trim(filter_var($_POST['password_confirm'], FILTER_SANITIZE_SPECIAL_CHARS));



    if(empty($username)||empty($email)||empty($password)){
        $errMsg='Заполни все поля!';
    }elseif (strlen($username)<2){
        $errMsg='Логин должен быть длиннее двух символов';
    } elseif ($password!==$password_confirm){
        $errMsg='Пароли не совпадают';
    } else{
        $existence=selectOne('users',['email'=>$email]);

        if($email=== $existence['email']){
            $errMsg='Пользователь с таким email уже есть!';

        }
        else{
            $pass=password_hash($password_confirm,PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $username,
                'email' => $email,
                'password' => $pass,
            ];

          $id=insert('users', $post);
          $user=selectOne('users',['id'=>$id]);
            loginUser($user);
        }

    }

}elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $username = '';
    $email ='';

}

//Обработка формы авторизации
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['button-auth'])){
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
    $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_SPECIAL_CHARS));


    $col=0;
    if(empty($email)||empty($pass)){
        $errMsg='Заполни все поля!';
    } else {
        $existence=selectOne('users',['email'=>$email]);

        if($email!== $existence['email']){
            $errMsg='Пользователь с таким email не найден!';
        } elseif (!password_verify($pass, $existence['password'])){

            if($col==3){}
            else{
                $errMsg='Неправильный пароль!';
                $col++;
            }

        } else{

            loginUser($existence);

        }

    }

}
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $email ='';

}



$id = '';
$username = '';
$email = '';
$role = '';
$password = '';
$password_confirm = '';
$users = selectAll('users');


//Добавление пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-create'])) {

    $admin = 0;
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
    $password_confirm=trim(filter_var($_POST['password_confirm'], FILTER_SANITIZE_SPECIAL_CHARS));
    $role = ($_POST['role']=== 'admin') ? 1 : 0;;


    if(empty($username)||empty($email)||empty($password)){
        $errMsg='Заполни все поля!';
    }elseif (strlen($username)<2){
        $errMsg='Логин должен быть длиннее двух символов';
    } elseif ($password!==$password_confirm){
        $errMsg='Пароли не совпадают';
    } else{
        $existence=selectOne('users',['email'=>$email]);

        if($email=== $existence['email']){
            $errMsg='Пользователь с таким email уже есть!';

        }
        else{
            $pass=password_hash($password_confirm,PASSWORD_DEFAULT);
            $post = [
                'admin' =>  $role,
                'username' => $username,
                'email' => $email,
                'password' => $pass,
            ];

            $id=insert('users', $post);
            $user=selectOne('users',['id'=>$id]);
            header('location: ' . BASE_URL . '/admin/users/index.php');
        }

    }

}else{
    $username = '';
    $email ='';
    $role = '';
    $password = '';
    $password_confirm = '';
}


// Редактирование пользователя
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $user = selectOne('users', ['id' => $_GET['id']]);
    $id = $user['id'];
    $admin = $user['admin'];
    $username = $user['username'];
    $email = $user['email'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-edit"])) {

    $id = $_POST['id'];
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $role = $_POST['role'];

    if(empty($username)||empty($email)){
        $errMsg='Заполни все поля!';
    } else {
        $existence=selectOne('users',['email'=>$email]);
        if($email=== $existence['email']){
            $errMsg='Пользователь с таким email уже есть!';

        }
        $user = [
            'username' => $username,
            'email' => $email,
            'admin' => $role === 'admin' ? 1 : 0
        ];

        update('users', $user, $id);
        header('location: ' . BASE_URL . '/admin/users/index.php');
    }
}


// Удаление пользователя
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["del_id"])) {
    $id = $_GET['del_id'];
    delete('users', $id);
    header('location: ' . BASE_URL . '/admin/users/index.php');
}

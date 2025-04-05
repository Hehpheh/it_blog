<?php
include "app/database/db.php";
include "app/href.php";

$errMsg = [];
$id = '';
$title = '';
$content = '';
$img = '';
$topic = '';
$status = '';

$topics = selectAll('topics');
$posts = selectAll('posts');
$postsAdm = selectAllFromPostsWithUsers('posts', 'users');

// Создание поста
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["add-posts"])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS));
    $content = trim($_POST['content']);
    $topic = trim(filter_var($_POST['topic'], FILTER_SANITIZE_SPECIAL_CHARS));
    $status = isset($_POST['publish_status']) ? 1 : 0;

    if (empty($title)) {
        $errMsg[] = "Заполни название";
    }

    if (empty($_FILES['img']['name'])) {
        $errMsg[] = "Загрузите изображение";
    } else {
        $imgName = $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];

        if (strpos($fileType, 'image') === false) {
            $errMsg[] = "Подгружаемый файл не является изображением!";
        } else {
            $destination = ROOT_PATH . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "posts" . DIRECTORY_SEPARATOR . $imgName;
            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result) {
                $_POST['img'] = $imgName;
            } else {
                $errMsg[] = "Ошибка загрузки изображения на сервер";
            }
        }
    }

    if (empty($errMsg)) {
        $post = [
            'id_user' => $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => $status,
            'topic_id' => $topic
        ];

        insert('posts', $post);
        header('location:' . BASE_URL ."/account.php?id=".$_SESSION['id']);
        exit();
    }
}


//Редактирование поста
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]);
    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $topic = $post['topic_id'];
    $status = $post['status'];


}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["edit-post"])) {

    $id = $_POST['id'];
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS));
    $content = trim($_POST['content']);
    $topic = trim(filter_var($_POST['topic'], FILTER_SANITIZE_NUMBER_INT));
    $status = isset($_POST['publish_status']) ? 1 : 0;

    if (empty($_FILES['img']['name'])) {
        $errMsg[] = "Загрузите изображение";
    } else {
        $imgName = $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "posts" . DIRECTORY_SEPARATOR . $imgName;

        if (strpos($fileType, 'image') === false) {
            $errMsg[] = "Подгружаемый файл не является изображением!";
        } else {
            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result) {
                $_POST['img'] = $imgName;
            } else {
                $errMsg[] = "Ошибка загрузки изображения на сервер";
            }
        }
    }


    if (empty($title)) {
        $errMsg[] = "Заполни название";
    } else {
        $post = [
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'topic_id' => $topic,
            'status' => $status

        ];

        update('posts', $post, $id);
        header('location:' . BASE_URL ."/account.php?id=".$_SESSION['id']);
        exit();
    }
}

//удаление поста
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["del_id"])) {
    $id = $_GET['del_id'];
    delete('posts', $id);
    header('location:' . BASE_URL ."/account.php?id=".$_SESSION['id']);
}



//Редактирование профиля

$id = $_SESSION['id'];
$user = selectOne('users', ['id' => $id]);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["edit-profile"])) {
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

    if (empty($username) || empty($email)) {
        $errMsg[] = 'Заполни все поля!';
    } elseif ($email === false) {
        $errMsg[] = "Неверный формат Email!";
    }

    $select_email = selectOne('users', ['email' => $email]);
    if ($select_email && $select_email['id'] != $id) {
        $errMsg[] = "Пользователь с таким email уже существует";
    }

    $select_username = selectOne('users', ['username' => $username]);
    if ($select_username && $select_username['id'] != $id) {
        $errMsg[] = "Пользователь с таким именем пользователя уже существует";
    }

    // Обработка изображения (если оно было загружено)
    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . "_" . $_FILES['img']['name'];  // Добавляем time(), чтобы сделать имя файла уникальным
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "/assets/img/users/" . $imgName;

        if (strpos($fileType, 'image') === false) {
            $errMsg[] = "Подгружаемый файл не является изображением!";
        } else {
            if (move_uploaded_file($fileTmpName, $destination)) {
                $imgToSave = $imgName;
            } else {
                $errMsg[] = "Ошибка загрузки изображения на сервер";
            }
        }
    }

    // Обновление данных пользователя
    if (empty($errMsg)) {
        $userUpdate = [
            'username' => $username,
            'email' => $email,
        ];

        // Добавляем изображение, если оно было загружено
        if (isset($imgToSave)) {
            $userUpdate['img'] = $imgToSave;
        }
        //Если загружено изображение, нужно перехватить и использовать ее.
        if (isset($imgName)) {
            $userUpdate['img'] = $imgName;
        }


        // Проверка пароля (если был введен новый пароль)
        if (!empty($_POST['new_password'])) {
            $old_password_from_db = selectOne('users', ['id' => $id])['password'];

            if (isset($_POST['old_password']) && password_verify($_POST['old_password'], $old_password_from_db)) {
                if (isset($_POST['new_password']) && isset($_POST['confirm_new_password']) && $_POST['new_password'] === $_POST['confirm_new_password']) {
                    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                    $userUpdate['password'] = $new_password;
                } else {
                    $errMsg[] = 'Новый пароль и подтверждение не совпадают';
                }
            } else {
                $errMsg[] = 'Неверный текущий пароль';
            }
        }
        if (isset($imgToSave)) {
            $userUpdate['img'] = $imgToSave;
        }


        update('users',  $userUpdate,$id);
        $_SESSION['username'] = $username;
        header('location:' . BASE_URL ."/account.php?id=".$_SESSION['id']);
        exit();
    }
}
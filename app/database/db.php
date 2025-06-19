<?php

session_start();
require 'connect.php';

function tt($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}
function tt2($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}


// проверка запроса к бд
function dbCheckError($query){
    $errInfo=$query->errorInfo();

    if($errInfo[0]!=='00000'){
        echo "Ошибка SQL: " . $errInfo[2];
        exit();
    }
    return true;
}

// запрос на получение всех данных из одной таблицы
function selectAll($table,$params=[]){
    global $pdo;
    $sql = "SELECT * FROM $table";
    $values=[];

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if ($i === 0) {
                $sql  .= " WHERE $key = ?";
            } else {
                $sql .= " AND $key =?";
            }
            $i++;
            $values[]=$value;
        }

    }
    $query= $pdo->prepare($sql);
    $query->execute($values);
    dbCheckError($query);
    return $query->fetchAll();
}


// запрос на получение одной строки из одной таблицы
function selectOne($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";
    $values = [];
    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key = ?";
            } else {
                $sql = $sql . " AND $key = ?";
            }
            $i++;
            $values[] =$value;
        }

    }

    $query= $pdo->prepare($sql);
    $query->execute($values);
    dbCheckError($query);
    return $query->fetch();

}


//Добавление
function insert($table, $params = []) {
    global $pdo;

    $keys = '';
    $placeholders = '';
    $values = [];

    $i = 0;
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $keys = $key;
            $placeholders = '?';
        } else {
            $keys .= "," . $key;
            $placeholders .= ",?";
        }

        $values[] = $value;
        $i++;
    }

    $sql = "INSERT INTO $table ($keys) VALUES ($placeholders)";

    $query = $pdo->prepare($sql);
    $query->execute($values);
    dbCheckError($query);

    return $pdo->lastInsertId();
}

//Обновление данных в таблице
function update($table,$params=[],$id){
    global $pdo;

    $values = [];
    $placeholders = '';
    $i = 0;
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $placeholders = $placeholders.$key."=?";
        } else {

            $placeholders =$placeholders.", ".$key."=?";
        }

        $values[] = $value;
        $i++;
    }


    $sql="UPDATE $table SET $placeholders WHERE id=$id";
    $query = $pdo->prepare($sql);
    $query->execute($values);
    dbCheckError($query);
}

//Удаление данных в таблтице
function delete($table,$id){

    global $pdo;

    $sql="DELETE FROM $table  WHERE id=$id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);

}

// Выборка записей (posts) с автором в админку
function selectAllFromPostsWithUsers($table1, $table2){
    global $pdo;
    $sql = "SELECT 
        t1.id,
        t1.title,
        t1.img,
        t1.content,
        t1.status,
        t1.topic_id,
        t1.created_date,
        t2.username
        FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();

}

//Выборка записей с автором в категории для category.php
function selectAllFromPostsWithUsersForCategoriesPage($table1, $table2, $params = [], $limit, $offset)
{
    global $pdo;
    $sql = "SELECT t1.*, t2.username FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id WHERE t1.status = 1 ";

    $values = [];
    if (!empty($params)) {
        $sql .= "AND ";
        $i = 0;
        foreach ($params as $key => $value) {
            if ($i > 0) {
                $sql .= "AND ";
            }
            $sql .= "$key = ?";
            $values[] = $value;
            $i++;
        }
    }
    $sql .= " LIMIT $limit OFFSET $offset";

    $query = $pdo->prepare($sql);
    $query->execute($values);
    dbCheckError($query);
    return $query->fetchAll();
}

// Выборка записей (posts) с автором c лимитом
function selectAllFromPostsWithUsersOnIndex($table1, $table2,$limit, $offset){
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status=1 LIMIT $limit OFFSET $offset ";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Выборка записей (posts) с автором на главную
function selectAllFromPostsWithUsersById($table1, $table2, $user_id, $limit, $offset){
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status=1 AND p.id_user = $user_id ORDER BY created_date DESC LIMIT $limit OFFSET $offset";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Выборка записи (posts) с автором для single страницы
function selectPostFromPostsWithUsersOnSingle($table1, $table2, $id){
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id=$id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

// Поиск по заголовкам и содержимому
function seacrhInTitileAndContent($text, $table1, $table2){
    $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
    global $pdo;
    $sql = "SELECT 
        p.*, u.username 
        FROM $table1 AS p 
        JOIN $table2 AS u 
        ON p.id_user = u.id 
        WHERE p.status = 1 
        AND (p.title LIKE '%$text%' OR p.content LIKE '%$text%')";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Считаем количество строк в таблице
function countRow($table, $params = []) {
    global $pdo;
    $sql = "SELECT COUNT(*) FROM $table";

    $values = [];
    if (!empty($params)) {
        $sql .= " WHERE ";
        $i = 0;
        foreach ($params as $key => $value) {
            if ($i > 0) {
                $sql .= " AND ";
            }
            $sql .= "$key = ?";
            $values[] = $value;
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute($values);
    dbCheckError($query);
    return $query->fetchColumn();
}

//получаем имя для пользователя комментария
function selectAllFromCommentsWithUsers($table1, $table2,$post_id){
    global $pdo;
    $sql = "SELECT 
        t1.id,
        t1.status,
        t1.page,
        t1.commentText,
        t1.user_id,
        t1.created_date,
        t2.username
        FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.user_id = t2.id WHERE t1.page = $post_id";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();

}
function selectAllFromCommentsAdm($table1, $table2, $limit, $offset){
    global $pdo;
    $sql = "SELECT 
        t1.id,
        t1.status,
        t1.page,
        t1.commentText,
        t1.user_id,
        t1.created_date,
        t2.email
        FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.user_id = t2.id   ORDER BY t1.created_date DESC LIMIT $limit OFFSET $offset";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();

}

/*Получаем все посты написанные пользователем*/

function selectAllPostsByUser($table1, $table2, $userId, $limit, $offset){
    global $pdo;

    $sql = "SELECT t1.*, t2.username FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id WHERE t1.id_user = $userId";
    $sql .= " LIMIT $limit OFFSET $offset";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
/*Получаем все посты лайкнутые пользователем*/
function selectAllPostsWithLikes($table1, $table2, $userId, $limit, $offset){
    global $pdo;

    $sql = "SELECT 
                posts.*, 
                users.username 
            FROM 
                $table1 AS likes  
            JOIN 
                posts ON likes.id_post = posts.id 
            JOIN 
                $table2 AS users ON posts.id_user = users.id  
            WHERE 
                likes.id_user = $userId";
    $sql .= " LIMIT $limit OFFSET $offset";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}


function isLiked($postId, $userId)
{
    global $pdo;
    $sql = "SELECT COUNT(*) FROM likes WHERE id_post = $postId AND id_user = $userId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count > 0;
}

function getLikesCount($postId)
{
    global $pdo;
    $sql = "SELECT COUNT(*) FROM likes WHERE id_post = $postId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count;
}
function selectAllFollowers($table1, $table2, $authorId){
    global $pdo;

    $sql = "SELECT 
                followers.*, 
                users.*
            FROM 
                $table1 AS followers
            JOIN 
                $table2 ON followers.follower_id = users.id 
            WHERE 
                followers.author_id = $authorId";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
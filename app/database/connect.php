<?php
$host     = 'localhost';
$dbname   = 'blog_0.9_version';
$username = 'root';
$password = '';
$options=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC
    ];
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password,$options);

} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . print_r($e->errorInfo(), true);
    die();
}




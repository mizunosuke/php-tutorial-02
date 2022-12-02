<?php
//db接続
try {
    $pdo = new PDO('mysql:host=localhost;dbname=newUser;charset=utf8mb4', 'root', '', array(PDO::ATTR_PERSISTENT => true));
} catch(PDOException $e) {
    echo "データベースに接続できませんでした:".$e -> get_massage();
}

?>
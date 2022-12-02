<?php
require("../db_connect.php");
//セッション開始
session_start();

//ログインボタンが押された場合
if(isset($_POST["login"])) {
    //POSTの中身が空でない場合
    if(!empty($_POST)) {
        try {
            //username,passwordが空じゃないか確認
            if($_POST["username"] === "" || $_POST["password"] === "") {
                $error = "入力内容が不足しています";
            } else {
                //dbから暗号化されたパスワードを引っ張ってきて入力されたものと一致するか確認
                $sql = 'SELECT password FROM user WHERE name= :name;';
                $stmt = $pdo -> prepare($sql);
                $stmt->bindValue(":name",$_POST["username"]);
                $stmt->execute();
                $pass = $stmt->fetch();
                var_dump($pass);

                if(password_verify($_POST["password"],$pass["password"])) {
                    //認証成功後の処理
                    //セッション変数にPOSTされたデータを保存
                    $_SESSION["logininfo"] = $_POST;
                    header("Location:../home.php");
                    exit();
                }
            }
        } catch(PDOException $e) {
            echo "接続失敗".$e->getMessage();
            die();
        }
              
    } else {
        echo "error サーバー接続に失敗しました";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <div class="login_container">
        <div>
            <h1>Log In</h1>
        </div>
        <form action="" method="POST">
            <div>
                <label for="">
                    お名前
                    <input type="text" name="username">
                </label>
            </div>

            <div>
                <label for="">
                    パスワード
                    <input type="password" name="password">
                </label>
            </div>
            <div>
                <input type="submit" value="login" name="login">
                <div><a href="register.php">新規登録画面へ</a></div>
            </div>
        </form>
    </div>
</body>
</html>

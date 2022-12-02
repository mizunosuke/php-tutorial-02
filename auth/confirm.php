<?php
//dbの接続
require("../db_connect.php");
session_start();


//セッション変数が空の場合register.phpへ返す
if(!isset($_SESSION["input_content"])) {
    header("Location:register.php");
    exit();
}

//登録ボタンが押されたら情報をDBに保存
if(!empty($_POST["check"])) {
    //パスワード暗号化
    $password = password_hash($_SESSION["input_content"]["password"],PASSWORD_BCRYPT);

    //dbに保存
    $sql = "INSERT INTO user SET name=?, email=?, password=?";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute(array(
        $_SESSION["input_content"]["name"],
        $_SESSION["input_content"]["email"],
        $password
    ));

    //home.phpへ移動
    header("Location:../mypage_setting.php");
    exit();
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録内容確認画面</title>
</head>
<body>
    <div class="confirm_container">
        <form action="" method="POST">
            <!-- 登録内容をPOSTで送るためにinputタグを配置 -->
            <input type="hidden" name="check" value="checked">
            <h1>登録内容確認</h1>
            <p>以下の内容で登録してよろしいですか?</p>
            <?php if (!empty($error) && $error === "error"): ?>
                <p class="error">＊会員登録に失敗しました。</p>
            <?php endif ?>
        
            <div>
                <p>お名前</p>
                <!-- <p>ここにPOSTで受け取った内容を入れる</p> -->
                <?=$_SESSION["input_content"]["name"]?>
            </div>

            <div>
                <p>メールアドレス</p>
                <!-- <p>ここにPOSTで受け取った内容を入れる</p> -->
                <?=$_SESSION["input_content"]["email"]?>
            </div>

            <div>
                <p>パスワード</p>
                <!-- <p>ここにPOSTで受け取った内容を入れる</p> -->
                <?=$_SESSION["input_content"]["password"]?>
            </div>
            <div>
                <button type="submit">この内容で登録する</button>
            </div>
        </form>
    </div>
</body>
</html>
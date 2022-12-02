<?php
//このページは初回登録時のみ表示
require("db_connect.php");
session_start();
// var_dump($_SESSION);
// exit();


//登録ボタンが押されたら
if(!empty($_POST["setmypage"])) {

    //-----ファイル処理関連-----
    //アップロードされたファイルを初期化
    $up_file  = "";
    //ファイルの状態を初期化
    $up_ok = false;

    //アップロードされたファイルを一時的な名前で保存(tmp_name)
    $tmp_file = isset($_FILES["imagefile"]["tmp_name"]) ? $_FILES["imagefile"]["tmp_name"] : "";
    //元のファイル名で保存するように元ファイル名を取得(nameは元パス)
    $origin_file = isset($_FILES["imagefile"]["name"]) ? $_FILES["imagefile"]["name"] : "";


    //ファイルが存在かつアップロードされたものだった場合
    if($tmp_file !== "" && is_uploaded_file($tmp_file)){
        //拡張子を取り出し$extに代入
        $split = explode(".",$origin_file); 
        $ext = end($split);

        //拡張子があるかつ拡張子名がファイル名でない場合
        if($ext != "" && $ext != $origin_file){
            //imageディレクトリの中に日付と1000から9999までの乱数を入れた名前のファイル名で保存->$up_file(保存先のパス)とする
            $up_file = "./image/". date("Ymd_His.") . mt_rand(1000,9999) . ".$ext";
            var_dump($up_file);
            //move_uploaded_fileで絶対パス($tmp_file)から相対パス($up_file)に保存先を変更
            $up_ok = move_uploaded_file($tmp_file, $up_file);
        }
    }

    //入力内容のバリデーション
    if($_POST["nickname"] === "") {
        $error = "blank";
    } else {
        //内容をDBに保存
        $stmt = $pdo->prepare("INSERT INTO `mypageSetting` (`nickname`, `area`, `favorite`, `prof_image`, `introduction`) VALUES (:nickname, :area, :favorite, :prof_image, :introduction);");

        //dbに名前付きプレースホルダで保存
        $stmt->bindValue(":nickname",$_POST["username"]);
        $stmt->bindValue(":area",$_POST["area"]);
        $stmt->bindValue(":favorite",$_POST["favo_fishing"]);
        $stmt->bindValue(":prof_image",$origin_file);
        $stmt->bindValue(":introduction",$_POST["textarea"]);

        //sql実行(dbに保存される)
        $stmt->execute();

        //登録データをログイン情報と紐づける
        
        //mypage.phpでログイン中のuserのmypageデータを表示させる(SESSION変数に入れる？)
        $_SESSION["mypageinfo"] = $_POST;
        header("Location:home.php");
        exit();

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ設定</title>
</head>
<body>
    <div class="mypage_container">
        <div>
            <h1>マイページ設定</h1>
            <?php if($error==="blank") :?>
                <p>ニックネームとエリアは必ず入力してください</p>
            <?php endif ;?>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="prof_img">
                <img src=<?=$up_file?> alt="">
                <div>
                    <div>
                        <button>写真を撮る</button>
                    </div>
                    <div>
                        <label for="">
                            ファイルをアップロードする
                            <input type="file" name="imagefile">
                        </label>
                    </div>
                </div>
            </div>

            <div class="user_info">
                <div>
                    <p>ユーザーネーム</p>
                    <span>必須</span>
                    <input type="text" name="username">
                </div>

                <div>
                    <p>釣りをする地域</p>
                    <span>必須</span>
                    <select name="area" id="">
                        <option value="" disabled>選択してください</option>
                        <option value="広島湾">広島湾</option>
                        <option value="太田川">太田川</option>
                        <option value="江田島">江田島</option>
                        <option value="倉橋島">倉橋島</option>
                        <option value="音戸の瀬戸">音戸の瀬戸</option>
                    </select>
                </div>

                <div>
                    <p>得意な釣り</p>
                    <input type="text" name="favo_fishing">
                </div>

                <div>
                    <p>自己紹介</p>
                    <textarea name="textarea" id="" cols="30" rows="10"></textarea>
                </div>
                <input type="submit" name="setmypage" value="保存">
            </form>
        </div>
    </div>
</body>
</html>
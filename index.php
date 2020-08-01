<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./total_style.css">
</head>
<body>

<?php
    // 共通ヘッダーの読み込み
    require("./header.php");

    $current_login_user_id = 0;

    // エラーメッセージの表示
    // ini_set('display_errors', 1);


    // 現在何かしらのアカウントがログインして居るとき
    if($_SESSION['login_user_id'] !== NULL && $_SESSION['login_user_id'] !== ""){
        // 現在ログイン中のユーザーのidを変数で格納する
        $current_login_user_id = $_SESSION['login_user_id'];
    }elseif($_SESSION['login_user_id'] === NULL || $_SESSION['login_user_id'] === ""){
        $current_login_user_id = 'NO USER';
    }
    // var_dump($_SESSION);
    // echo "<br>";
    // var_dump($_SESSION['login_user_id']);
    // echo '<br>';
    // echo 'sessionあります';


    // データベース接続のファイルの読み込み
    require("./dbconnect.php");

    $sql = 'SELECT * FROM posts';
    $statement = $pdo->query($sql);

    $arr = $statement->fetchAll(PDO::FETCH_NUM);

    // すでに投稿されている大学の大学名
    $univ_arr = [];

    foreach($arr as $data){
        // 繰り返し処理のついでに大学名を配列に格納する
        array_push($univ_arr, $data[1]);    
    }
    $univ_arr = array_unique($univ_arr);
?>


<!-- 大学名を絞るフォーム -->
<div class="current-post-univs">
    <label class=current-post-univ-label>現在投稿されている大学</label>
    <form action="only-one-univ.php" method="post" class="current-post-form">

        <?php if($univ_arr === []): ?>
            <select name="only-one-univ" class="univ-option">
                <option>まだどこの大学の情報も投稿されていません</option>
            </select>
        <?php else: ?>
            <select name="only-one-univ" class="univ-option">
                <?php foreach($univ_arr as $univ): ?>
                    <option><?php echo $univ; ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <input type="submit" value="大学を絞る" class="univ-button">
        <?php endif; ?>
        
    </form>
</div>



<!-- 実際の投稿を表示 -->
<div class="contents">
<hr>
    <?php foreach($arr as $data): ?>
        <label>大学名 : 学部名</label>
        <p class="post-content"><?php echo $data[1]?> : <?php echo $data[2]?></p>
        <label>教授名</label>
        <p class="post-content"><?php echo $data[3]?></p>
        <label>評価</label>
        <p class="post-content"><?php echo $data[4]?></p>
        <label>投稿者のコメント</label>
        <p class="post-content"><?php echo $data[5]?></p>

        <?php if($current_login_user_id === $data[6]): ?>

            <div class="buttons">
                
                <form action="edit_post_form.php" method="post" class="edit-form">
                    <input type="hidden" name="edit_post_id" value="<?php echo $data[0]; ?>">
                    <input type="submit" value="編集する" class="edit-button">
                </form>

                <form action="delete_post_form.php" method="post" class="delete-form">
                    <input type="hidden" name="delete_post_id" value="<?php echo $data[0]; ?>">
                    <input type="submit" value="削除する" class="delete-button">
                </form>

            </div>
        <?php endif; ?>
<br>
<hr>
    <?php endforeach; ?>
</div>





</body>
</html>
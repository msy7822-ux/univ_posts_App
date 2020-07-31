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
    session_start();
    // SESSIONを開始する関数
    // session_start();

    // ※「ホーム」のページは「ログアウト」ボタンを押したときしか表示しないようにする

    // 特定のユーザーがログアウトしたときの処理------------------------------------------
    // ログアウトするユーザーのidを受け取る変数の用意
    $logout_user_id = '';

    // ログアウトするユーザーのidの受取を実際に行う
    $logout_user_id = $_POST['logout_user_id'];

    if($logout_user_id !== ""){
        $_SESSION['login_user_id'] = '';
    }

?>


<ul class="home-list">
    <li><a href="./create_user_form.php">/ 新規ユーザー登録 </a></li>
    <li><a href="./login_form.php">/ ログインフォーム </a></li>
    <li><a href="./index.php">/ 投稿一覧ページ </a></li>
</ul>

<h1 class="home-title">ホーム</h1>

<img src="./images/img1.jpg" class="home-img">

</body>
</html>
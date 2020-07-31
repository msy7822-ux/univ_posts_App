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
    // データベース接続したファイルの読み込み
    require("./dbconnect.php");
?>

<ul class="login-form-list">
    <li><a href="./home.php">/ ホームへ戻る </a></li>
    <li><a href="./create_user_form.php">/ 新規登録ページ </a></li>
    <li><a href="./index.php">/ 投稿一覧ページ </a></li>
</ul>

<h1 class="login-form-title">ログインフォーム</h1>

<form action="login_do.php" method="post" class="login-form">
    <input type="text" name="name" placeholder="名前を入力してください" required class="login-form-name">
    <input type="password" name="password" placeholder="パスワードを入力してください" required class="login-form-password">
    <br>
    <input type="text" name="email" placeholder="メールアドレスを入力してください" required class="login-form-email">
    <br>
    <br>
    <input type="submit" value="ログインする" class="login-form-button">
</form>

</body>
</html>
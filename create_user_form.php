<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Univ_Posts_App</title>
    <link rel="stylesheet" href="./total_style.css">
</head>
<body>

<?php 
    // 共通ヘッダーの読み込み
    // require("./header.php");
?>
<ul class="create-user-list">
<li><a href="./home.php">/ ホーム </a></li>
<li><a href="./login_form.php">/ ログインページ </a></li>
<li><a href="./index.php">/ 投稿一覧ページ </a></li>
</ul>

<h1 class="create-user-title">ユーザー登録</h1>

<form action="create_user_do.php" method="post" required class="create-user-form">
    <input type="text" name="name" placeholder="名前を入力してください" required class="create-user-name">
    <br>
    <input type="text" name="password" placeholder="パスワードを入力してください" required class="create-user-password">
    <br>
    <input type="text" name="email" placeholder="メールアドレスを入力してください" required class="create-user-email">
    <br>
    <br>
    <input type="submit" value="登録する" class="create-user-button">
    <div class="footer-create"></div>
</form>

</body>
</html>
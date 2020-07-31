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
    // 必要性があるかは不明だが、一応、データベース接続ページの読み込み
    require("./dbconnect.php");
    $current_user = "";

    session_start();
    if($_SESSION['login_user_id'] !== NULL){
        $current_user = $_SESSION['login_user_id'];

        var_dump($_SESSION);
        echo "<br>";
        var_dump($_SESSION['login_user_id']);
        echo '<br>';
        echo 'sessionあります';

    }elseif($_SESSION['login_user_id'] === NULL){
        $current_user = "NO USER";
    }
    // if($_SESSION['login_user_id'] !== ""){
    //     $current_user = $_SESSION['login_user_id'];
    // }elseif($_SESSION['login_user_id'] === ""){
    //     $current_user = "NO USER";
    // }
?>

<div class="header">
    <?php if($current_user === "NO USER"): ?>
        <ul class="header-list">
            <li><a href="./home.php">/ ホーム </a></li>
            <li><a href="./create_user_form.php">/ 新規登録ページ </a></li>
            <li><a href="./login_form.php">/ ログインページ </a></li>

            <li class="header-right">現在ログインしているユーザーIDは、<?php echo $current_user; ?></li>
        </ul>
    <?php else: ?>
        <ul class="header-list">
            <li><a href="./create_post_form.php">/ 投稿ページ </a></li>
            <li><a href="./index.php">/ 投稿一覧ページ </a></li>

            <li class="header-right">現在ログインしているユーザーIDは、<?php echo $current_user; ?></li>
        </ul>

        <div class="buttons">

            <form action="./my_page.php" method="post" class="my-page-form">
                <input type="hidden" name="login_user_id" value="<?php echo $current_user; ?>">
                <input type="submit" value="マイページ" class="my-page-form-button">
            </form>

            <form action="./home.php" method="post" class="logout-form">
                <input type="hidden" name="loguot_user_id" value="<?php echo $current_user; ?>">
                <input type="submit" value="ログアウト" class="logout-form-button">
            </form>

        </div>
    <?php endif; ?>
    <br>
</div>

</body>
</html>


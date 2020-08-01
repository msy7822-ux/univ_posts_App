<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Univ_Posts_App</title>
</head>
<body>
<?php
    // データベース接続ファイルの読み込み
    require("./dbconnect.php");
    // ヘッダーページの読み込み
    require("./header.php");

    // 現在ログイン中のユーザーのidを変数で受け取る
    $current_login_user_id = $_SESSION['login_user_id'];

    // ユーザーがみたい大学名を受け取る
    $univ_name = $_POST['only-one-univ'];
    
    $sql = 'SELECT * FROM posts WHERE univ_name=:univ_name';
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':univ_name', $univ_name, PDO::PARAM_STR);

    $statement->execute();

    $array = $statement->fetchAll(PDO::FETCH_NUM);
?>

<button class="shift-to-index"><a href="./index.php">投稿一覧ページへ戻る</a></button>

<div class="contents">
<hr>
<?php foreach($array as $data): ?>
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
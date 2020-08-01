<!-- ユーザーアカウントの個人ページ -->
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
    // このページはユーザーログインしていることが前提

    require("./dbconnect.php");
    require("./header.php");

    // どのユーザー（user_id）のマイページかのidの受け渡し
    $current_user_id = $_POST['login_user_id'];

    // ユーザーが投稿した投稿のみを表示する
    $sql = 'SELECT * FROM posts WHERE user_id=:user_id';
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':user_id', $current_user_id, PDO::PARAM_INT);
    $statement->execute();

    $array = $statement->fetchAll(PDO::FETCH_NUM);
    # ここでは、この$arrayは二重の配列になっているので注意
?>

<button class="shift-to-index"><a href="./index.php">投稿一覧ページへ戻る</a></button>
<br>
<h1 class="my-page-header" style="display:inline-block; background-color: rgba(4,163,181,1);
color: #fff; border-radius: 4px; padding: 8px 12px;">マイページ</h1>

<p class="user-number" style="background-color: rgba(4,163,181,1); color: #fff; border-radius: 4px; padding: 8px 12px;">あなたのユーザー番号は、<?php echo $current_user_id; ?></p>
<hr>


<?php if(count($array) !== 0): ?>

<div class="contents">
<?php foreach($array as $data): ?>
    <label>大学名 : 学部名</label>
        <p class="post-content"><?php echo $data[1]?> : <?php echo $data[2]?></p>
        <label>教授名</label>
        <p class="post-content"><?php echo $data[3]?></p>
        <label>評価</label>
        <p class="post-content"><?php echo $data[4]?></p>
        <label>投稿者のコメント</label>
        <p class="post-content"><?php echo $data[5]?></p>
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
<br>
<hr>
<?php endforeach; ?>
</div>

<?php else: ?>
    <p>あなたは、まだ投稿をしていません</p>
    <a href="./create_post_form.php" class="mypage-do-post">投稿する</a>
<?php endif; ?>

</body>
</html>
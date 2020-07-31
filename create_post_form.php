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
    // header.phpで開始されているからわざわざ関数を書く必要はない
    // sessioｎの開始関数
    // session_start();
    $easy_class = ["S", "A", "B", "C", "D"];
?>

<div class="create-post">

<form action="./create_post_do.php" method="post" class="create-post-form">
    <input type="hidden" name="post_user" value="<?php echo $_SESSION['login_user_id']; ?>">

    <label style="color: #fff;">大学名：</label>
    <br>
    <input type="text" name="univ_name" placeholder="大学名を入力してください" required class="form-input">
    <br>
    <label style="color: #fff;">学部名：</label>
    <br>
    <input type="text" name="faculity" placeholder="学部名を入力してください" required class="form-input">
    <br>
    <label style="color: #fff;">教授の名前：</label>
    <br>
    <input type="text" name="professor_name" placeholder="教授の名前を入力してください" required class="form-input">
    <br>
    <br>
    <label style="color: #fff;">教授の授業の評価：</label>
    <select name="easy_class" required  class="form-select">
        <?php foreach($easy_class as $str): ?>
        <option value="<?php echo $str; ?>"><?php echo $str; ?></option>
        <?php endforeach; ?>
    </select>

    <br>
    <br>

    <textarea name="other_info" cols="30" rows="10" placeholder="その教授や授業、課題などの詳細情報を教えてください" required></textarea>

    <input type="submit" value="投稿する">
</form>

</div>

</body>
</html>
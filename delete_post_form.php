<?php 
    // データベース接続ページの読み込み
    require("./dbconnect.php");

    // 削除するID値の受取
    $delete_post_id = $_POST['delete_post_id'];

    $sql = 'DELETE FROM posts WHERE id=:delete_post_id';
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':delete_post_id', $delete_post_id, PDO::PARAM_INT);
    $statement->execute();
    
    // 削除時のアラート表示
    $alert = "<script type='text/javascript'>alert('投稿の削除を行いました。');</script>";
    echo $alert;
?>

<br>
<a href="./index.php" style="text-decoration: none; background-color: grey; color: #fff; padding: 8px 12px;">投稿一覧ページへ遷移する</a>
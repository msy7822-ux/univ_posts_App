<?php 
    // データベース接続を読み込む
    require("./dbconnect.php");
    // エラーメッセージの表示
    ini_set('display_errors', 1);

    // ここで受けとったデータは、空欄ではないことが前提
    $univ_name = $_POST['univ_name'];
    $faculity = $_POST['faculity'];
    $professor_name = $_POST['professor_name'];
    $easy_class = $_POST['easy_class'];
    $other_info = $_POST['other_info'];

    // ここではユーザーのid番号が渡される
    $user_id = $_POST['post_user'];

    // サクセスメッセージ
    $success_message = "";
    // エラーメッセージ
    $error_message = "";

    if(strpos($univ_name, "大学") === false){
        $error_message = "お手数ですが、語尾に「大学」を含めてご記入ください";
    }elseif(strpos($faculity, "学部") === false){
        $error_message = "お手数ですが、語尾に「学部」を含めてご記入ください";
    }else{
        $sql = 'INSERT INTO posts (univ_name, faculity, professor_name, easy_class, other_info, user_id) VALUES (:univ_name, :faculity, :professor_name, :easy_class, :other_info, :user_id)';

        $statement = $pdo->prepare($sql);
        $statement->bindParam(':univ_name', $univ_name, PDO::PARAM_STR);
        $statement->bindParam(':faculity', $faculity, PDO::PARAM_STR);
        $statement->bindParam(':professor_name', $professor_name, PDO::PARAM_STR);
        $statement->bindParam(':easy_class', $easy_class, PDO::PARAM_STR);
        $statement->bindParam(':other_info', $other_info, PDO::PARAM_STR);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        $statement->execute();

        $success_message = "新規投稿に成功しました";
    }

?>

<!-- サクセスメッセージが代入されているとき -->
<?php if($error_message === ""): ?>
    <p style="color: red;"><?php echo $success_message; ?></p>
    <a href="./index.php" style="text-decoration: none; background-color: grey; color: #fff; padding: 8px 12px;">投稿一覧ページへ遷移する</a>
<?php endif; ?>

<?php if($error_message !== ""): ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
    <a href="./create_post_form.php" style="text-decoration: none; background-color: grey; color: #fff; padding: 8px 12px;">新規投稿ページでやり直す</a>
<?php endif; ?>
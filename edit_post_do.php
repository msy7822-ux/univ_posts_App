<?php 
    // データベース接続ファイルを読み込む
    require("./dbconnect.php");

    // 受けとったデータはクランがないことが前提
    $edit_post_id = $_POST['edit_post_id'];

    $univ_name = $_POST['univ_name'];
    $faculity = $_POST['faculity'];
    $professor_name = $_POST['professor_name'];
    $easy_class = $_POST['easy_class'];
    $other_info = $_POST['other_info'];

    // サクセスメッセージ
    $success_message = "";
    // エラーメッセージ
    $error_message = "";

    if(strpos($univ_name, "大学") === false){
        $error_message = "お手数ですが、語尾に「大学」を含めてご記入ください";
    }elseif(strpos($faculity, "学部") === false){
        $error_message = "お手数ですが、語尾に「学部」を含めてご記入ください";
    }else{
        $sql = 'UPDATE posts SET univ_name=:univ_name, faculity=:faculity, professor_name=:professor_name, easy_class=:easy_class, other_info=:other_info WHERE id=:edit_post_id';

        $statement = $pdo->prepare($sql);
        $statement->bindParam(':univ_name', $univ_name, PDO::PARAM_STR);
        $statement->bindParam(':faculity', $faculity, PDO::PARAM_STR);
        $statement->bindParam(':professor_name', $professor_name, PDO::PARAM_STR);
        $statement->bindParam(':easy_class', $easy_class, PDO::PARAM_STR);
        $statement->bindParam(':other_info', $other_info, PDO::PARAM_STR);
    
        $statement->bindParam(':edit_post_id', $edit_post_id, PDO::PARAM_STR);
    
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
    <form action="edit_post_form.php" method="post">
        <input type="hidden" name="edit_post_id" value="<?php echo $edit_post_id; ?>">
        <input type="submit" value="投稿ページでやり直す"　style="text-decoration: none; background-color: grey; color: #fff; padding: 8px 12px;">
    </form>
<?php endif; ?>
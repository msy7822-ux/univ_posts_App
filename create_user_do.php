<?php 

    # いったん、データベースの接続を呼び出して、pdoを使えるようにしておく
    require("./dbconnect.php");

    // エラーメッセージの表示
    ini_set('display_errors', 1);

    // 入力されたデータを受けとって変数に格納する
    // 空欄ではないことが前提
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];


    // サクセスメッセージ
    $success_message = '';
    // エラーメッセージ
    $error_message = '';

    if(strpos($email, "@") === false || strpos($email, ".com") === false){
        $error_message = "メールアドレスが有効ではありません。もう一度登録しなおしてください。";
    }else{

        $sql = 'SELECT * FROM users WHERE name=:name AND password=:password AND email=:email';

        $statement = $pdo->prepare($sql);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
    
        $statement->execute();
    
        $array = $statement->fetchAll(PDO::FETCH_NUM);
    
        if($array !== []){
            $error_message = "ユーザーアカウントが重複しています。ユーザーアカウントを登録し直してください。";
        }else{
            // 次に変数に格納したデータをデータベースに保存する
            $sql = 'INSERT INTO users (name, password, email) VALUES (:name, :password, :email)';
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':name', $name, PDO::PARAM_STR);
            $statement->bindParam(':password', $password, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);

            $statement->execute();

            $success_message = "ユーザー登録が完了しました";
        }

    }

?>

<?php if($error_message === ""): ?>
    <p style="color: red;"><?php echo $success_message; ?></p>
    <a href="./login_form.php" style="text-decoration: none; background-color: grey; color: #fff; padding: 8px 12px;">ログインページへ遷移する</a>
<?php else: ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
    <a href="./create_user_form.php" style="text-decoration: none; background-color: grey; color: #fff; padding: 8px 12px;">ユーザー登録をしなおしてください</a>
<?php endif; ?>


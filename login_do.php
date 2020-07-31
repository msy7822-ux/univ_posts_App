<?php 
    require("./dbconnect.php");

    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = 'SELECT * FROM users WHERE name=:name AND password=:password AND email=:email';

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);

    $statement->execute();

    $array = $statement->fetchAll(PDO::FETCH_NUM);
    // var_dump($array);

    // ログインメッセージを格納する変数
    $login_message = "";
    // エラーメッセージ
    $error_message = "";

    // //　Cookieでログインを管理
    // setcookie('login_user_id', '', time()+60*60, '/', 'xxxxx.com', true, true）

    $_SESSION['login_user_id'] = '';

    if($array !== []){
        $array = $array[0];

        $login_message = "ログインに成功しました。";
        session_start();
        $_SESSION['login_user_id'] = $array[0];

    }else{
        $error_message = "アカウントが見つかりません。ユーザー登録を行ってください。";
    }
?>

<?php if($login_message !== ""): ?>
    <p style="color: red;"><?php echo $login_message; ?></p>
    <a href="./index.php" style="text-decoration: none; background-color: grey; color: #fff; padding: 8px 12px;">投稿一覧ページへ</a>
<?php elseif($error_message !== ""): ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
    <a href="./create_user_form.php" style="text-decoration: none; background-color: grey; color: #fff; padding: 8px 12px;">ユーザー登録ページへ</a>
<?php endif; ?>
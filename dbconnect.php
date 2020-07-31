<?php 

    // pdo接続のためのプログラム

    // エラーメッセージの表示
    ini_set('display_errors', 1);

    try{

        $dsn = 'mysql:dbname=tb220104db;host=localhost;charset=utf8';
        $user = 'tb-220104';
        $password = 'TEywzDmNne';
        
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    }catch(PDOException $e){
        $error = $e->getMessage();
        echo "データベース接続エラー：".$error;
    }

?>
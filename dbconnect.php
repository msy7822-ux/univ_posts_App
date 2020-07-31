<?php 

    // pdo接続のためのプログラム

    // エラーメッセージの表示
    ini_set('display_errors', 1);

    try{
        $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
        $db['dbname'] = ltrim($db['path'], '/');

        $dsn = "mysql:dbname={$db['dbname']};host={$db['host']};charset=utf8";
        $user = $db['user'];
        $password = $db['pass'];

        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
        );
        
        $pdo = new PDO($dsn, $user, $password, $options);

    }catch(PDOException $e){
        $error = $e->getMessage();
        echo "データベース接続エラー：".$error;
    }

?>
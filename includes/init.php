<?php
ob_start();
session_start();

//2. DB接続
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=login_db; charset=utf8; host=localhost', 'root', 'root');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}

$from_email="admin@gmail.com";
$reply_email="admin@gmail.com";
include "php_functions.php";

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

?>
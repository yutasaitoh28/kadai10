<?php include "includes/init.php" ?>
<?php
require_once('includes/php_functions.php');

$title = $_POST['title'];
$content  = $_POST['content'];
$img_name = '';
$username=$_SESSION['username'];

// imgがある場合
if ($_SESSION['post']['image_data']) {
    $img_name = date('YmdHis') . '_' . $_SESSION['post']['file_name'];
}

/**
 * (1)$_FILES['img']['tmp_name']... 一時的にアップロードされたファイル
 * (2)'../picture/' . $image...写真を保存したい場所。先にフォルダを作成しておく。
 * (3)move_uploaded_fileで、（１）の写真を（２）に移動させる。
 */
if ($_SESSION['post']['image_data']) {
    file_put_contents('./images/' . $img_name, $_SESSION['post']['image_data']);
}

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO gs_content_table(
    title,content,img,date,username
)VALUES(
    :title,:content,:img,sysdate(),:username
)');
$stmt->bindValue(':title', $title, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':content', $content, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':img', $img_name, PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':username', $username, PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

redirect('index.php');
?>
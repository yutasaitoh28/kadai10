<?php include "includes/init.php" ?>
<?php
require_once('includes/php_functions.php');

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare('SELECT * FROM gs_content_table');
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status == false) {
    sql_error($stmt);
} else {
    $contents = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">
<?php include "includes/header.php" ?>
<body id="main">
    <?php include "includes/nav.php" ?>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" style="display:flex;flex-wrap:wrap;">
                <?php foreach ($contents as $content): ?>
                    <div class="col" style="margin-bottom:30px;width:33rem;margin-right:30px;margin-left:30px;">
                        <div class="card shadow-sm" style="background-color:#FFFAF0;border-radius:10px;">
                            <?php if ($content['img']): ?>
                                <img src="./images/<?=$content['img']?>" alt="" class="bd-placeholder-img card-img-top" style="width:100%;border:none;border-radius:10px;">
                            <?php else: ?>
                            <img src="./images/default_image/no_image_logo.png" alt="" class="bd-placeholder-img card-img-top" style="width:100%;border-radius:10px;">
                            <?php endif ?>
                        <div class="card-body" style="padding-left:30px;padding-top:10px;padding-bottom:10px;">
                            <h3><?= $content['title'] ?></h3>
                            <p class="card-text">記事内容：<?= nl2br($content['content']) ?></p>
                            <p>投稿者：<?= $content['username'] ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">登録日:<?= $content['date'] ?></small>
                            </div>
                            <?php if (!is_null($content['update_time'])): ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">更新日:<?= $content['update_time'] ?></small>
                            </div>
                            <?php endif ?>
                        </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</body>
</html>
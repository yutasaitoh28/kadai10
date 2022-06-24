<?php include "includes/init.php" ?>
<?php
    if (logged_in()) {
        $username=$_SESSION['username'];
    } else {
        redirect("index.php");   
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "includes/header.php" ?>
    <body>
        <?php include "includes/nav.php" ?>

        <div class="container">
            <?php 
                show_msg();
            ?>
            <h1 class="text-center"><?php echo $username ?>さんのコンテンツ</h1>
            <form method="POST" action="confirm.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">タイトル</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="title" value="<?= $title ?>">
                    <div id="emailHelp" class="form-text">※入力必須</div>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">記事内容</label>
                    <textArea type="text" class="form-control" name="content" id="content" aria-describedby="content" rows="4" cols="40"><?= $content ?></textArea>
                    <div id="emailHelp" class="form-text">※入力必須</div>
                </div>
                <?php if ($image_data): ?>
                <img src="image.php">
                <?php endif;?>
                <div class="mb-3">
                    <label for="img" class="form-label">画像投稿</label>
                    <input type="file" name="img">
                </div>
                <button type="submit" class="btn btn-primary">確認する</button>
            </form>
        </div> <!--Container-->
        
        <?php include "includes/footer.php" ?>
    </body>
</html>
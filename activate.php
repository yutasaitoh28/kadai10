<?php include "includes/init.php" ?>
<?php
    if (isset($_GET['user'])) {
        $user = $_GET['user'];
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            $db_code = get_validationcode($user, $pdo);
            if ($code == $db_code) {
                try {
                    $stmnt=$pdo->prepare("UPDATE users SET active=1 WHERE username=:username");
                    $stmnt->execute([':username'=>$user]);
                    set_msg("認証が完了しました。ログインをしてください。", "success");
                    redirect('index.php');
                } catch(PDOException $e) {
                    echo "Error: {$e}";
                }
            } else {
                set_msg("認証コードがマッチしません。");
                redirect('index.php');
            }
        } else {
            set_msg("認証コードが存在しません。");
            redirect('index.php');
        }
    } else {
        set_msg("ユーザーが存在しません。");
        redirect('index.php');
    }
?>
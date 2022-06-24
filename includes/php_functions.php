<?php
    function redirect($loc) {
        header("Location: {$loc}");
    }

    function generate_token() {
        return md5(microtime().mt_rand());
    }
    function logged_in(){
        if(isset($_SESSION['username'])){
            return true;
        }else{
            if(isset($_COOKIE['username'])){
                $_SESSION['username'] = $_COOKIE['username'];
                return true;
            }else{
                return false;
            }
        }     
    }

    function set_msg($msg, $level='danger') {
        if (($level!='primary') && ($level!='success') && ($level!='info') && ($level!='warning')) {
            $level='danger';
        }
        if (empty($msg)) {
            unset($_SESSION['message']);
        } else {
            $_SESSION['message']="<h4 class='bg-{$level} text-center'>{$msg}</h4>";
        }
    }

    function show_msg(){
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }

    function send_mail($to, $subject, $body, $from, $reply) {
        $headers = "From: {$from}"."\r\n"."Reply-To: {$reply} "." \r\n "."X-Mailer: PHP/".phpversion();
        if ($_SERVER['SERVER_NAME'] != "localhost") {
            mail($to, $subject, $body, $headers);
            set_msg("Email sent to '{$to}'. Please check email to activate your account");
            redirect('index.php');
        } else {
            echo "<hr><p>To: {$to}</p><p>Subject: {$subject}</p><p>{$body}</p><p>".$headers."</p><hr>";
        }
    }

//   ******************  データベースの関数  ********************************

        //DB接続
        function db_conn()
        {
            try {
                $db_name = 'login_db';    //データベース名
                $db_id   = 'root';      //アカウント名
                $db_pw   = 'root';      //パスワード：XAMPPはパスワード無しに修正してください。
                $db_host = 'localhost'; //DBホスト
                $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
                return $pdo;
            } catch (PDOException $e) {
                exit('DB Connection Error:' . $e->getMessage());
            }
        }

    function count_field_val($pdo, $tbl, $fld, $val) {
         try {
              $sql="SELECT {$fld} FROM {$tbl} WHERE {$fld}=:value";
              $stmnt=$pdo->prepare($sql);
              $stmnt->execute([':value'=>$val]);
              return $stmnt->rowCount();
         } catch(PDOException $e) {
              return $e->getMessage();
         }
    }

    function return_field_data($pdo, $tbl, $fld, $val) {
         try {
              $sql="SELECT * FROM {$tbl} WHERE {$fld}=:value";
              $stmnt=$pdo->prepare($sql);
              $stmnt->execute([':value'=>$val]);
              return $stmnt->fetch();
         } catch(PDOException $e) {
              return $e->getMessage();
         }
    }

    function get_validationcode($user, $pdo) {
         try {
              $stmnt=$pdo->prepare("SELECT validationcode FROM users WHERE username=:username");
              $stmnt->execute([':username'=>$user]);
              $row = $stmnt->fetch();
              return $row['validationcode'];
         } catch(PDOException $e) {
              return $e->getMessage();
         }        
    }
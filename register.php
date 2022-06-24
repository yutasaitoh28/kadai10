<?php include "includes/init.php" ?>
<?php
    if ($_SERVER['REQUEST_METHOD']=="POST"){
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $uname = $_POST['username'];
        $email = $_POST['email'];
        $email_conf = $_POST['email_confirm'];
        $pword = $_POST['password'];
        $pword_conf = $_POST['password_confirm'];
        $comments = $_POST['comments'];

        if(strlen($uname)<6){
            $error[] = "ユーザー名は6文字以上に設定してください。";
        }
        if(strlen($pword)<6){
            $error[] = "パスワードは6文字以上に設定してください。";
        }
        if ($pword != $pword_conf){
            $error[] = "パスワードがマッチしません。";
        }
        if ($email != $email_conf){
            $error[] = "メールアドレスがマッチしません。";
        }
        if(count_field_val($pdo, "users", "username", $uname)!=0){
            $error[] = "入力されたユーザーは既に存在します。";
        }
        if(count_field_val($pdo, "users", "email", $uname)!=0){
            $error[] = "入力されたメールアドレスは既に登録されています。";
        }

        if (!isset($error)) {
            $vcode=generate_token();
            try {
                $sql = "INSERT INTO users (firstname, lastname, username, email, password, comments, validationcode, active, joined, last_login) VALUES (:firstname, :lastname, :username, :email, :password, :comments, :vcode, 0, current_date, current_date)";
                $stmnt = $pdo->prepare($sql);
                $user_data = [':firstname'=>$fname, ':lastname'=>$lname, ':username'=>$uname, ':email'=>$email, ':password'=>password_hash($pword, PASSWORD_BCRYPT), ':comments'=>$comments, ':vcode'=>$vcode];
                $stmnt->execute($user_data);
                redirect("index.php");
                // $body = "<p>Please click on the link below to activate your acoount</p><p><a href='activate.php?user={$uname}&code={$vcode}'>Activate Account</a></p>";
                // send_mail($email, "Active User", $body, $from_email, $reply_email);
            } catch(PDOException $e) {
                echo "Error: ".$e->getMessage();
            }
        }

    }else{
        $fname = "";
        $lname = "";
        $uname = "";
        $email = "";
        $email_conf = "";
        $pword = "";
        $pword_conf = "";
        $comments = "";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "includes/header.php" ?>
    <body>
        <?php include "includes/nav.php" ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <?php 
                        show_msg();
                        if(isset($error)){
                            foreach($error as $msg){
                                echo "<h4 class='bg-danger text-center'>{$msg}</h4>";
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="register-form" method="post" role="form" >
                                        <div class="form-group">
                                            <input type="text" name="firstname" id="firstname" tabindex="1" class="form-control" placeholder="First Name" value="<?php echo $fname ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="lastname" id="lastname" tabindex="2" class="form-control" placeholder="Last Name" value="<?php echo $lname ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" tabindex="3" class="form-control" placeholder="Username" value="<?php echo $uname ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" id="register_email" tabindex="4" class="form-control" placeholder="Email Address" value="<?php echo $email ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email_confirm" id="confirm_email" tabindex="4" class="form-control" placeholder="Confirm Email Address" value="<?php echo $email_conf ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="5" class="form-control" placeholder="Password" value="<?php echo $pword ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_confirm" id="password_confirm" tabindex="6" class="form-control" placeholder="Confirm Password" value="<?php echo $pword_conf ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="comments" id="comments" tabindex="7" class="form-control" placeholder="Comments">value="<?php echo $comments ?>"</textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-custom" value="新規登録">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "includes/footer.php" ?>
    </body>
</html>
<nav class="navbar navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">ブログ画面</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if(logged_in()){
                            echo "<li><a href='mycontent.php'>マイページ</a></li>";
                            echo "<li><a href='logout.php'>ログアウト</a></li>";
                        }else{
                            echo "<li><a href='login.php'>ログイン</a></li>";
                            echo "<li><a href='register.php'>新規登録</a></li>";
                        }
                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
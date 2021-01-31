<!DOCTYPE html>
    <html lang="ja">
    <head>
      <?php include 'templates/head.php'; ?>
      <title>新規会員登録</title>
      <style>
          .register{ text-align: center;}
          .password{ margin-left: 30px;}
      </style>
      <link rel= "stylesheet" href ="./css/common.css">
    </head>
    <body>
        <!-- エラーメッセージの表示のためのテンプレート -->
        <?php include 'templates/err_msg.php'; ?>
        <!-- ヘッダーのテンプレート -->
        <?php include 'templates/header.php'; ?>
        
        <div class="register">
        <h2>新規会員登録</h2>
            <?php if($_SESSION['join'] === null): ?>
            <form action="register.php" method = "post">
                <p class="name">ユーザーネーム：
                <input type="text" name="user_name" placeholder="半角英数字６文字以上">
                </p>
                <p class="password">パスワード：
                <input type="password" name="user_password" placeholder="半角英数字６文字以上">
                </p>
                <input type="submit" value="登録する">
                <input type="hidden"  name = "token" value="<?php print h($token); ?>">
            </form>
                <p><a href="login.php">ログインはこちら</a></p>
                <form method="post" action= "login.php">
                    <input type = "submit" value="ゲストユーザとしてログインする">
                    <input type = "hidden" name = "user_name" value = "gestuser">
                    <input type = "hidden" name = "user_password" value = "gestuser">
                    <input type="hidden"  name = "token" value="<?php print h($token); ?>">
                </form>
        </div>
        <?php else: ?>
                <h2><a href="login.php">早速ログインする</a></h2>
        <?php endif; ?>
        
        
        
        
        
     
    </body>
    </html>
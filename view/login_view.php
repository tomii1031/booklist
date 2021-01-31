<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include 'templates/head.php'; ?>
  <link rel="stylesheet" href="./css/common.css">
  <style>
  .login{ text-align: center;}
  .password{ margin-left: 30px;}
 </style>
</head>
<body>
    
  <!-- エラーメッセージの表示のためのテンプレート -->
  <?php include 'templates/err_msg.php'; ?>
  <!-- ヘッダーのテンプレート -->
 <?php include 'templates/header.php'; ?>
   

  <div class="login">
        <h2>ログイン画面</h2>
            <form action="login.php" method = "post">
                <p class="name">ユーザーネーム：
                <input type="text" name="user_name" placeholder="半角英数字６文字以上">
                </p>
                <p class="password">パスワード：
                <input type="password" name="user_password" placeholder="半角英数字６文字以上">
                </p>
                <input type="hidden" name ="token" value="<?php print h($token); ?>">
                <input type="submit" value="ログインする">
            </form>
             <a href="register.php"><p>新規登録はこちら</p></a>
             <form method="post">
               <input type = "submit" value="ゲストユーザとしてログインする">
               <input type = "hidden" name = "user_name" value = "gestuser">
               <input type = "hidden" name = "user_password" value = "gestuser">
               <input type="hidden"  name = "token" value="<?php print h($token); ?>">
             </form>
        </div>
</body>
</html>

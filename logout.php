<?php 

session_start();
// セッション変数からuser_id取得
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  // 非ログインの場合、ログインページへリダイレクト
  header('Location: login.php');
  exit;
  
}



$session_name = session_name();


$_SESSION = array();


if (isset($_COOKIE[$session_name])) {
  // sessionに関連する設定を取得
  $params = session_get_cookie_params();
 
  // sessionに利用しているクッキーの有効期限を過去に設定することで無効化
  setcookie($session_name, '', time() - 42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
  );
}


session_destroy();


header('Location: login.php');
exit();











?>
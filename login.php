<?php

session_start();
ob_start();

require_once './conf/const.php';
require_once './model/common_function.php';
require_once './model/db.php'; 
require_once './model/user.php';


$user_name = '';
$user_password = '';
$sql = '';
$data = array();
$err_msg = array();
    
    

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //csrf対策
    include './view/templates/token_check.php';
   
    $user_name = get_post('user_name');

    $user_password = get_post('user_password');

    if($user_name === ''){
        $err_msg[] = 'ユーザーネームを入力してください';
     }
                 
     if($user_password === ''){
        $err_msg[] = 'パスワードを入力してください';
     }            
                 
     if(preg_match("/^[a-zA-Z0-9]+$/", $user_name) !== 1){       
        $err_msg[] = 'ユーザーネームは半角英数字を入力してください';
     }
               
     if(preg_match("/^[a-zA-Z0-9]+$/", $user_password) !== 1){
        $err_msg[] = 'パスワードは半角英数字を入力してください';
     }
               
     if(strlen($user_name) < 6){
       $err_msg[] = 'ユーザーネームは6文字以上入力してください';
     }
               
     if(strlen($user_password) < 6){
        $err_msg[] = 'パスワードは6文字以上入力してください';
     }
    
    //データベース接続
    $db = get_db_connect();
    
    $data = get_login_user($db, $user_name);
                       
    if (isset($data[0]['user_id']) && password_verify($user_password, $data[0]['password'])){
        // セッション変数にuser_idを保存
        $_SESSION['user_id'] = $data[0]['user_id'];
        echo 'ログイン成功';
        // ログイン済みユーザのホームページへリダイレクト
        header('Location: index.php');
    } else {
        echo '存在しないユーザーです';
    }
}

$token = get_csrf_token();
include_once './view/login_view.php';








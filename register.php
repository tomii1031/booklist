<?php  
session_start();
ob_start(); 

require_once './conf/const.php';
require_once './model/common_function.php';
require_once './model/db.php'; 
require_once './model/user.php'; 

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

  $hash = password_hash($user_password, PASSWORD_DEFAULT);

   //データベース接続
   $db = get_db_connect();
  
  //すでに登録済みのユーザー情報を取得するfunction
  $data = get_user($db, $user_name);
                  
  if((int)$data[0]['count'] > 0){
                    
     $err_msg[] = '既に登録されているユーザーネームです。';

  }
 
  if(count($err_msg) === 0){
    if(insert_user($db, $user_name, $hash) === false){
       echo '登録に失敗しました';
    }else{
       echo '登録できました';
    }
    $_SESSION['join'] = $_POST;
  }
}
$token = get_csrf_token();
include_once './view/register_view.php';





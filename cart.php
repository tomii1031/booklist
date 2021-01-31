<?php

session_start();
ob_start();
// セッション変数からuser_id取得
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  // 非ログインの場合、ログインページへリダイレクト
  header('Location: login.php');
  exit;
  
}

require_once './conf/const.php';
require_once './model/db.php';
require_once './model/common_function.php';
require_once './model/book.php';
require_once './model/index_add_cart.php';
require_once './model/book_cart.php';

        
$img_dir = './img/';    
$data = array();
$book_id = '';
$sql_kind = '';
$err_msg = array();
$sum = '';
$price = '';
$update_stock = '';
$img = '';
$amount = '';

                  
$db = get_db_connect();
                      
$sql_kind = get_post('sql_kind');
                     
$book_id = get_post('book_id');
                     
                     
if($sql_kind === 'delete'){
  //csrf対策
  include './view/templates/token_check.php';
                    
  if(delete_cart($db, $book_id) === false){
    $err_msg[] ='商品の削除に失敗しました';
  }else{
    echo '商品を削除しました';
  }
                    
}
else if($sql_kind === 'update'){
  //csrf対策
  include './view/templates/token_check.php';

  $update_amount = (int)get_post('update_amount');
                
  if(preg_match('/^[0-9]+$/', $update_amount) !== 1){
    $err_msg[] = '在庫数は0以上の整数で指定してください';
  }
  if(preg_match('/^[\.]/', $update_amount)){
    $err_msg[] = '在庫数は0以上の整数で指定してください';
  }
  
  $book_id = get_post('book_id');

  if(count($err_msg) === 0){
    
    if(update_cart_amount($db, $update_amount, $book_id) === false){
        $err_msg[] ='商品の更新に失敗しました';
    }else{
        echo '購入個数を変更しました';
    }

  }
}
                
$data = get_user_cart($db, $user_id);

$total_price = sum_cart($data);
$token = get_csrf_token();
include_once './view/cart_view.php';




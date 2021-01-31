<?php

session_start();
//セッション変数からuser_id取得
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
require_once './model/finish.php';


$img_dir = './img/';
$data = array();        
$err_msg = array();        
$sum = '';        
$total='';

//csrf対策
include './view/templates/token_check.php';

$db = get_db_connect();
                   
$data = get_total_cart($db, $user_id);

$total_price = sum_cart($data);
                    
foreach($data as $book){
                        
  if($book['stock'] < $book['amount']){
                            
  $err_msg[] = '購入予定数が在庫数を超えています。';
                            
  }
                        
  if(count($err_msg) === 0){
    if(update_stock_number($db, $book['amount'], $book['book_id']) === false){
      exit;
    }
  }
                        
}
                  
if(count($err_msg) === 0){
                           
  if(delete_unset_cart($db, $user_id) === false){
    exit;
  }
}

include_once './view/result_view.php';



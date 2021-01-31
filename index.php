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
require_once './conf/const.php';
require_once './model/db.php';
require_once './model/common_function.php';
require_once './model/book.php';
require_once './model/index_add_cart.php';
require_once './model/books_pagination.php';
require_once './model/book_cart.php';

$data = array();
$img_dir = './img/'; 
$err_msg = array(); 
    
//データベース接続
$db = get_db_connect();
                     
$sql_kind = get_post('sql_kind');
                     
if($sql_kind === 'insert'){
  //csrf対策
  include './view/templates/token_check.php';
                     
  $book_id = (int)get_post('book_id');
                   
  $amount = get_post('amount');

  $carts = get_cart($db, $user_id, $book_id);

    if(empty($carts)){
      insert_cart($db,  $user_id, $book_id, $amount);
      echo '商品をカートに入れました。';
    }
    else if($carts[0]['book_id'] === $book_id){
      update_cart($db, $user_id, $book_id, $carts[0]['amount']);
      echo '商品の購入数を変更しました';
    }
    else{
      echo 'カートに入れることができませんでした';
    }
}
else if ($sql_kind === 'select'){
  //csrf対策
  include './view/templates/token_check.php';

  $book_status = get_post('book_status');

  $kind = array(0,1,2,3,4);
                       
  if(!in_array((int)$book_status, $kind)){
    $err_msg[] = '本の状態を選んでください';
  }
                 
  $book_select = BOOK_SELECTS[$book_status];

  //商品の状態で検索して取得するfunction
  if(count($err_msg) === 0){
    $selects = get_book_status($db, $book_status);
  }
}
else if($sql_kind === 'book_type'){
  //csrf対策
  include './view/templates/token_check.php';
                       
  $book_info = get_post('book_info');
                      
  $os = array(0,1,2,3);
  if(!in_array((int)$book_info, $os)){
      $err_msg[] = '本の種類を選んでください';
  }
 
  $book_type = BOOK_KIND[$book_info];
                       
  if(count($err_msg) === 0){
    //商品のジャンルで検索して取得するfunction
    $types = get_book_info($db, $book_info);
  }
                       
}
                 
//全商品を取得するfunction              
//$data = get_all_books($db);
include 'index_pagination.php';
                    
//商品を新着順で取得する
$recommend = get_new_books($db);
                    
//ユーザの情報を取得する                    
$users = get_user($db, $user_id);

$token = get_csrf_token();
include_once './view/index_view.php';




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
require_once './model/user.php';
require_once './model/book_comment.php';
require_once './model/pagination.php';

$img_dir = './img/';
$books = array();
$users = array();
$err_msg = array();
$login_user = array();
$sql_kind = '';
$page = '';
       

                     
if($_SERVER['REQUEST_METHOD'] === 'GET'){
  $page = isset($_GET['page']) ? (int)$_GET['page'] : '';

  $book_id = '';

  if(isset($_GET['book_id']) === true){
     $book_id = (int)$_GET['book_id'];
  }

  if($page === '' && $book_id === ''){
      header('Location: index.php');
  }   
 
  $db = get_db_connect();
 
  //ページネーションの共通部分
  include 'comment_paginate.php';
                  
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
                
  $db = get_db_connect();
                  
  $book_id = (int)get_post('book_id');

  $sql_kind = get_post('sql_kind');
                  
                
                
  if($sql_kind === 'insert'){
    //csrf対策
    include './view/templates/token_check.php';

    $comment = get_post('comment');
                  
    if(strlen($comment) === 0){
        $err_msg[] = 'コメントを入力してください';
    }
                  
    if(count($err_msg) === 0){

      if(insert_comment($db, $book_id, $user_id, $comment) === false){
          echo 'コメントの入力に失敗しました';
      }
                       
     }
  }
  else if($sql_kind === 'delete_form'){
    //csrf対策
    include './view/templates/token_check.php';
                
    $comment_id = (int)get_post('comment_id');
              
    $user_id = (int)get_post('user_id');

    if($_SESSION['user_id'] !== $user_id){
        $err_msg[] = '他人の投稿は削除できません';
    }

    if(count($err_msg) === 0){

      if(delete_book_comment($db, $comment_id, $user_id) === false){
         echo '削除に失敗しました。';
      }

    }

  }
  //ページネーションの共通部分
  include 'comment_paginate.php';
}
$token = get_csrf_token();
include_once './view/comment_view.php';




                      

<?php
//コントーラー

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

$img_dir = './img/';
 
$err_msg = array();
        
//画像のアップロード
if($_SERVER['REQUEST_METHOD'] === 'POST'){

   $sql_kind = get_post('sql_kind');
        
  if($sql_kind === 'insert'){
    
    //画像アップロードのためのテンプレート
    include 'tool_img.php';
    }
}

//データベース接続
$db = get_db_connect();
        
          
if($sql_kind === 'insert'){
  //csrf対策
  include './view/templates/token_check.php';
  //商品をinsertのテンプレート
  include 'tool_insert.php';
}
else if($sql_kind === 'change'){
  //csrf対策
  include './view/templates/token_check.php';
  //商品を公開する、非公開にするテンプレート  
  include 'tool_change.php';
}
else if($sql_kind === 'update'){
  //csrf対策
  include './view/templates/token_check.php';
  //商品のストックをupdateするテンプレート              
  include 'tool_update_stock.php';
                
}
else if($sql_kind === 'update_promotion'){
  //csrf対策
  include './view/templates/token_check.php';
  //商品のPR文を変更するテンプレート
  include 'tool_update_promotion.php';

}
else if($sql_kind === "delete"){
  //csrf対策
  include './view/templates/token_check.php';
  //商品の削除をするテンプレート
  include 'tool_delete.php';
                
}
//商品情報を取得するfunction
$books = get_books($db, $user_id);

//選択された本の状態、ジャンルを文字に変換する
foreach($books as $book){
    $book_type = BOOK_KIND[$book['book_info']];
    $book_status = BOOK_SELECTS[$book['book_status']];
}
           
$token = get_csrf_token();
include_once './view/tool_view.php';










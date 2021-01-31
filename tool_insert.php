<?php


$book_name = get_post('book_name');

$book_price = get_post('price');
              
$status = get_post('status');

$stock = get_post('stock');

$promotion = get_post('promotion');
             
$author = get_post('author');
            
$book_status = get_post('book_status');
                
$book_info = get_post('book_info');

             
if($book_name ===''){
    $err_msg[]= '商品の名前を入力してください。';
}
              
if($book_price ===''){
   $err_msg[]= '商品の値段を入力してください。';
}else if(preg_match('/^[0-9]+$/', $book_price) !== 1){
   $err_msg[] = '商品の値段は0以上の整数を指定してください。';
}else if(preg_match('/^[\.]/', $book_price)){
   $err_msg[] = '商品の値段は0以上の整数で指定してください';
}
              
              
if($stock === ''){
   $err_msg[] = '商品の個数を入力してください';
}else if(preg_match('/^[0-9]+$/', $stock) !== 1){
   $err_msg[] = '商品の個数は0以上の整数で指定してください';
}
               
               
if(!($status === '1' || $status === '0')){
  $err_msg[] = 'ステータスは公開か非公開を選択してください';
}

if($author === ''){
   $err_msg[] = '著者の名前を入力してください';
}

if($promotion === ''){
   $err_msg[] = '商品のPRポイントを記入してください';
}
else if(mb_strlen($promotion) >= 100){
   $err_msg[] = '商品のPRポイントは100文字以下にしてください';
}
                
$kind = array(-1,0,1,2,3,4);
                
if(!in_array((int)$book_status, $kind)){
    $err_msg[] = '本の状態を選んでください';
}
                      
$os = array(0,1,2,3);
if(!in_array((int)$book_info, $os)){
    $err_msg[] = '本の種類を選んでください';
}
                 
                      
if(count($err_msg) === 0){
  $db->beginTransaction();

  if(insert_book($db, $book_name, $book_price, $status, $book_img, $book_status, $book_info, $author, $promotion, $user_id) === false){
      echo '商品の登録に失敗しました';
      $db->rollback();
      exit;
  }
                     
  $book_id = $db->lastInsertId();

  if(insert_book_stock($db, $book_id, $stock) === false){
      echo '商品の登録に失敗しました';
      $db->rollback();
      exit;
  }
                      
   $db->commit();
}
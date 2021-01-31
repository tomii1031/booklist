<?php

$update_stock = get_post('update_stock');
              
if(preg_match('/^[0-9]+$/', $update_stock) !== 1){
   $err_msg[] = '在庫数は0以上の整数で指定してください';
   }
if(preg_match('/^[\.]/', $update_stock)){
   $err_msg[] = '在庫数は0以上の整数で指定してください';
   }
              
$book_id = get_post('book_id');
if(count($err_msg) === 0){
  if(update_book_stock($db, $update_stock, $book_id) === false){
      $err_msg[] ='在庫の変更に失敗しました';
  }else{
      echo '在庫数を変更しました.';
  }
              
}
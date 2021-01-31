<?php


$change_status = get_post('change_status');
                
$book_id = get_post('book_id');
                
if(!($change_status === '0'|| $change_status === '1')){
    $err_msg[] = 'ステータスは0か１を入力してください';
  }

if(count($err_msg) === 0){
             
  if(update_book_status($db, $change_status, $book_id) === false){
    $err_msg[] ='ステータスの変更に失敗しました';
  }else{
    echo '公開ステータスを更新しました。';
  }  
                  
}
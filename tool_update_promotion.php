<?php

$book_id = get_post('book_id');
$promotion = get_post('promotion');

if($promotion === ''){
   $err_msg[] = '商品のPRポイントを記入してください';
}
else if(mb_strlen($promotion) >= 100){
   $err_msg[] = '商品のPRポイントは100文字以下にしてください';
}

if(count($err_msg) === 0){
if(update_book_promotion($db, $promotion, $book_id) === false){
     $err_msg[] ='商品のPR文更新に失敗しました';
}else{
     echo 'PR文を変更しました';
}
}

            

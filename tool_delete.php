<?php

$book_id = get_post('book_id');

if(delete_book($db, $book_id) === false){
      $err_msg[] ='商品の削除に失敗しました';
}else{
    echo '商品を削除しました';
}
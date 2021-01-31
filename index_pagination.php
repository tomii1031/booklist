<?php

$page = isset($_GET['page']) ? (int)$_GET['page'] : '';

$item_num = get_count_books_table($db);


//総ページ数を計算するsql
$max_page = (int)ceil($item_num['id'] / 5);

//現在のページを取得する
$page_num = get_page($page);
                      
if($page_num > $max_page){
  $page_num = $max_page;
}

$start = books_page_start($page_num);
                      
$data = get_books_pagination($db, $start);

if($page_num === $max_page){
   $item_fin = $item_num['id'];
}else{
   $item_fin = $start+5;
}






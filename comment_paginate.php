<?php

$books = select_book_info($db, $book_id);

$comment_num = get_count_table($db, $book_id);

$login_user_info =  select_book_user($db, $book_id);

$login_user_id = $login_user_info['user_id'];

//総ページ数を計算するsql
$max_page = (int)ceil($comment_num['id'] / 4);

//現在のページを取得する
$page_num = get_page($page);
                      
if($page_num > $max_page){
  $page_num = $max_page;
}

$start = page_start($page_num);
                      
$comments = get_comment_pagination($db, $book_id,$start);

if($page_num === $max_page){
   $comment_fin = $comment_num['id'];
}else{
   $comment_fin = $start+4;
}


$book_type = BOOK_KIND[$books[0]['book_info']];

$book_status = BOOK_SELECTS[$books[0]['book_status']];

//現在ログイン中のuserの情報
$users = get_user_id($db, $login_user_id);




<?php

require_once 'common_function.php';
require_once 'db.php'; 


function get_page($page){

  if(false === isset($page)){

    $page_num = 1;

  }else{

    $page_num = $page;

    if(1 > $page_num){

      $page_num = 1;
    }

  }

  return $page_num;

}



function get_count_books_table($db){
  $sql = "
  SELECT
    COUNT(*)id
  FROM
    books
  JOIN
    book_stock
  ON
    books.book_id = book_stock.book_id
";

return fetch_query($db, $sql);

}

function books_page_start($page_num){
  if($page_num > 1){
     $start = ($page_num * 5) -5;
  }else{
    $start = 0;
  }
  return $start;
}

function get_books_pagination($db, $start){

        $sql = "
        SELECT
          *
        FROM
          books
        JOIN
          book_stock
        ON 
          books.book_id = book_stock.book_id
        LIMIT :start, 5
      ";

$params = array(':start' => $start);

return fetch_all_query($db, $sql, $params);

}






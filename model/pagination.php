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



function get_count_table($db, $book_id){
  $sql = "
  SELECT
    COUNT(*)id
  FROM
    book_comment
  WHERE
   book_id = :book_id
";

$params = array(':book_id' => $book_id);

return fetch_query($db, $sql, $params);

}

function page_start($page_num){
  if($page_num > 1){
     $start = ($page_num * 4) -4;
  }else{
    $start = 0;
  }
  return $start;
}

function get_comment_pagination($db, $book_id, $start){

        $sql = "
        SELECT
          *
        FROM
          book_comment
        JOIN
          users
        ON 
          book_comment.user_id = users.user_id
        WHERE
        book_id = :book_id
        ORDER BY book_comment.create_datetime DESC
        LIMIT :start, 4
      ";

$params = array(':book_id' => $book_id,':start' => $start);

return fetch_all_query($db, $sql, $params);

}






<?php

require_once 'common_function.php';
require_once 'db.php'; 

function insert_comment($db, $book_id, $user_id, $comment){

  $sql = "
            INSERT INTO
      book_comment(
                  book_id,
                  user_id,
                  comment
                  )
       VALUES(:book_id, :user_id, :comment)
       ";

       $params = array(':book_id' => $book_id, ':user_id' => $user_id, ':comment' => $comment);
      
       return execute_query($db, $sql, $params);

}


function select_book_user($db, $book_id){

  $sql = "
         SELECT
          user_id
         from
          books
        WHERE 
          book_id = :book_id
        ";

        $params = array(':book_id' => $book_id);
      
    
    return fetch_query($db, $sql, $params);
}

function get_comment_user($db, $book_user_id){

  $sql = "
         SELECT
          *
         from 
          users
         WHERE
          user_id = :user_id
         ";

    $params = array(':user_id' => $book_user_id);

    return fetch_query($db, $sql, $params);

}


function select_book_info($db, $book_id){

    $sql = "
          SELECT
            *
          FROM
            books
          JOIN
            book_stock
          ON
           books.book_id = book_stock.book_id
          WHERE
           books.book_id = :book_id
    
      ";

      $params = array(':book_id' => $book_id);

      return fetch_all_query($db, $sql, $params);

}


function get_book_comment($db, $book_id){

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
              book_comment.book_id = :book_id
           ";

        $params = array(':book_id' => $book_id);

    return fetch_all_query($db, $sql,$params);

}






function delete_book_comment($db, $comment_id, $user_id){

   
    $sql = "
    DELETE
    FROM
      book_comment
    WHERE
      comment_id = :comment_id
    AND
      user_id = :user_id  
      
    ";

    $params = array(':comment_id' => $comment_id, ':user_id' => $user_id);

    return execute_query($db, $sql, $params);


}


function update_book_comment($db, $comment_id, $user_id){

    $sql = "
    UPDATE
      book_comment
    SET
      comment = :comment
    WHERE 
      comment_id = :comment_id
    AND
      user_id = :user_id
  ";

  $params = array(':comment_id' => $comment_id, ':user_id' => $user_id);

  return execute_query($db, $sql, $params);

}

function select_edit_comment($db, $comment_id, $user_id){

  $sql = "
        SELECT
          *
        FROM
          book_comment
        WHERE 
          comment_id = :comment_id
        AND
          user_id = :user_id
    ";

    $params = array(':comment_id' => $comment_id, ':user_id' => $user_id);
    
    return fetch_all_query($db, $sql, $params);

}





















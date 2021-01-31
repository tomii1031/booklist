<?php 
//model

require_once 'common_function.php';
require_once 'db.php'; 


//本の状態で検索
function get_book_status($db, $book_status){

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
            books.book_status = :book_status
          ";

          $params = array(':book_status' => $book_status);

        return fetch_all_query($db, $sql, $params);
}

//本のジャンルによって検索
function get_book_info($db, $book_info){

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
            books.book_info = :book_info
          ";

        $params = array(':book_info' => $book_info);

        return fetch_all_query($db, $sql, $params);

}

//全ての商品の情報を検索
function get_all_books($db){

    $sql = "
    SELECT
      *
    FROM
      books
    JOIN 
      book_stock
    ON
      books.book_id = book_stock.book_id
    ";

  return fetch_all_query($db, $sql);

}

//新着順で商品を取得する
function get_new_books($db){

  $sql = "
  SELECT
    *
  FROM
    books
  JOIN 
    book_stock
  ON
    books.book_id = book_stock.book_id
  ORDER BY books.create_datetime DESC LIMIT 4
  ";

  return fetch_all_query($db, $sql);
}


function get_user($db, $user_id){
   
  $sql = "
        SELECT
          *
        FROM
         users
        WHERE
         user_id = :user_id
        ";
    
    $params = array(':user_id' => $user_id);

    return fetch_all_query($db, $sql, $params);

}


function insert_cart($db, $user_id, $book_id, $amount){

  $sql = "
         INSERT INTO
           book_cart(
               user_id,
               book_id,
               amount
              )
           VALUES(:user_id, :book_id, :amount)
           ";

           $params = array(':user_id' => $user_id, ':book_id' => $book_id, ':amount' => $amount);

           return execute_query($db, $sql, $params);

}


function update_cart($db, $user_id, $book_id, $amount){

        $sql = "
                UPDATE
                  book_cart
                SET
                  amount = :amount
                WHERE 
                  user_id = :user_id
                AND
                  book_id = :book_id
               ";

       $params = array(':amount' => $amount+1, ':user_id' => $user_id, ':book_id' => $book_id);

       return execute_query($db, $sql, $params);
}

function get_cart($db, $user_id, $book_id){

    $sql = "
            SELECT
              *
            FROM
              book_cart
            WHERE
              user_id = :user_id
            AND
              book_id = :book_id
            ";

      $params = array(':user_id' => $user_id, ':book_id' => $book_id);

      return fetch_all_query($db, $sql, $params);
}



















<?php

 require_once 'common_function.php';
 require_once 'db.php'; 


 function delete_cart($db, $book_id){

    $sql = "
            DELETE
            FROM
              book_cart
            WHERE
              book_cart.book_id = :book_id
             ";
        $params = array(':book_id' => $book_id);

        return execute_query($db, $sql, $params);
 }


 function update_cart_amount($db, $update_amount, $book_id){

        $sql = "
                UPDATE
                  book_cart
                SET
                  amount = :amount
                WHERE 
                  book_id = :book_id 
               ";

        $params = array(':amount' => $update_amount, ':book_id' => $book_id);

        return execute_query($db, $sql, $params);

 }


 function get_user_cart($db, $user_id){
    
    $sql = "
            SELECT 
              *
            FROM
              book_cart
            JOIN
              books
            ON
              book_cart.book_id = books.book_id
            WHERE
              book_cart.user_id = :user_id
            ";
      
    $params = array(':user_id' => $user_id);

    return fetch_all_query($db, $sql, $params);
 }

function sum_cart($data){
  $total_price = 0;
  foreach($data as $d){
    $total_price += $d['price'] * $d['amount'];
  }
  return $total_price;
}



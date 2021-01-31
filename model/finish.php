<?php

//model

function get_total_cart($db, $user_id){

    $sql = "
           SELECT 
            *
           FROM
            book_cart
           JOIN
            books
           ON
            book_cart.book_id = books.book_id
           JOIN
            book_stock
           ON 
            book_cart.book_id = book_stock.book_id
          WHERE
            book_cart.user_id = :user_id
        ";

        $params = array(':user_id' => $user_id);

        return fetch_all_query($db, $sql, $params);

}



function update_stock_number($db, $amount, $book_id){

    $sql = "
          UPDATE
            book_stock
          SET
            stock = stock - :amount
          WHERE
            book_id = :book_id  
        ";

      $params = array(':amount' => $amount, ':book_id' => $book_id);

      return execute_query($db, $sql, $params);


}

function delete_unset_cart($db, $user_id){

        $sql = "
        DELETE
        FROM
          book_cart
        WHERE
          user_id = :user_id  
      ";

      $params = array(':user_id' => $user_id);

      return execute_query($db, $sql, $params);
   
}



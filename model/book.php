<?php
 require_once 'common_function.php';
  require_once 'db.php'; 


function insert_book($db, $book_name, $book_price, $status, $book_img, $book_status, $book_info, $author, $promotion, $user_id){
    
      $sql = "
      INSERT INTO 
       books( 
           book_name, 
           price, 
           status, 
           img, 
           book_status,
           book_info,
           author,
           promotion,
           user_id
           
       )
       VALUES(:book_name, :price, :status, :img, :book_status, :book_info, :author, :promotion, :user_id)
      ";
      
      $params = array(':book_name' => $book_name, ':price' => $book_price, ':status' => $status, ':img' => $book_img, 
      ':book_status' => $book_status,  ':book_info' => $book_info, ':author' => $author, 'promotion' => $promotion, ':user_id' => $user_id);
      
      return execute_query($db, $sql, $params);

}

function insert_book_stock($db, $book_id, $stock){
    
       $sql ="  INSERT INTO 
                book_stock(
                           book_id,
                           stock 
                          )
                VALUES(:book_id, :stock)
            ";
            
            $params = array(':book_id' => $book_id, ':stock' => $stock);
            
            return execute_query($db, $sql, $params);
                
}



function update_book_status($db, $change_status, $book_id){

 $sql = "
        UPDATE
          books
         SET
          status = :status
         WHERE
          book_id = :book_id
         ";
  $params = array(':status' => $change_status, ':book_id' => $book_id);

  return execute_query($db, $sql, $params);

}

function update_book_stock($db, $update_stock, $book_id){
    $sql = "
           UPDATE
             book_stock
           SET
             stock = :stock
           WHERE
            book_id = :book_id
           ";

    $params = array(':stock' => $update_stock, 'book_id' => $book_id);

    return execute_query($db, $sql, $params);

}


function delete_book($db, $book_id){

    $sql = "
           DELETE
            books,
            book_stock
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

     return execute_query($db, $sql, $params);
}

function get_books($db, $user_id){
    
    $sql = "
           SELECT
            books.book_id,
            books.book_name,
            books.img,
            books.price,
            books.book_info,
            books.book_status,
            books.promotion,
            books.author,
            books.status,
            book_stock.stock
           FROM
            books
           JOIN
            book_stock
           ON
            books.book_id = book_stock.book_id
           WHERE
            books.user_id = :user_id
        ";

    $params = array(':user_id' => $user_id);

    return fetch_all_query($db, $sql, $params);

}


function update_book_promotion($db, $promotion, $book_id){

  $sql = "
        UPDATE
          books
        SET
          promotion = :promotion
        WHERE
          book_id = :book_id
       ";

       $params = array(':promotion' => $promotion,':book_id' => $book_id);

      return execute_query($db,$sql, $params);
}










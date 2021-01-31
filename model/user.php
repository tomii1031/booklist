<?php
require_once 'common_function.php';
require_once 'db.php'; 


function get_user($db, $user_name){


    $sql = "
          SELECT
          COUNT(*)
          AS
            count
          FROM
            users
          WHERE
            user_name = :user_name
          ";

      $params = array(':user_name' => $user_name);

      return fetch_all_query($db, $sql, $params);

}


function insert_user($db, $user_name, $password){

      $sql = "
            INSERT INTO 
            users( 
                user_name, 
                password
            )
            VALUES(:user_name, :password)
     ";

     $params = array(':user_name' => $user_name, ':password' => $password);

      
      return execute_query($db, $sql, $params);
}


function get_login_user($db, $user_name){

  $sql = "
          SELECT
            user_id,
            password
          FROM
            users
          WHERE
            user_name = :user_name
          ";

      $params = array(':user_name' => $user_name);

      return fetch_all_query($db, $sql, $params);


}


function get_user_id($db, $user_id){

    $sql = "
            SELECT
              *
            FROM
              users
            WHERE
              user_id = :user_id
            ";

      $params = array(':user_id' => $user_id);

      return fetch_query($db, $sql, $params);

}
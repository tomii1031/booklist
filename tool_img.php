<?php

if(is_uploaded_file($_FILES['img_file']['tmp_name']) === TRUE){
  $extension = pathinfo($_FILES['img_file']['name'], PATHINFO_EXTENSION);
  if( $extension === 'jpg'||$extension === 'jpeg' || $extension === 'png'){
      $book_img = sha1(uniqid(mt_rand(), true)). '.' . $extension;
      if(is_file($img_dir . $book_img)!== TRUE){
          if(move_uploaded_file($_FILES['img_file']['tmp_name'],$img_dir . $book_img) !== TRUE){
              $err_msg[] = 'ファイルアップロードに失敗しました';
          }
      }else{
          $err_msg[] = 'ファイルアップロードに失敗しました。再度お試しください。';
      }
  }else{
      $err_msg[] = 'ファイル形式が異なります。画像ファイルはJPEG,jpg,pngのみ利用可能です。';
  }
}else{
  $err_msg[] = 'ファイルを選択してください';
}
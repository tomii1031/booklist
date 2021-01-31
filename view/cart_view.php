<!DOCTYPE html>
<html lang="ja">
    <head>
      <?php include 'templates/head.php'; ?>
      <link rel ="stylesheet" href="./css/cart.css">
      <link rel= "stylesheet" href ="./css/common.css">
      <style>
        .total_price{ text-align: center;}
        .cart-item{ width: 200px; height: 550px;  margin: 0 20px;}
      </style>
    </head>
        <body>
             <!-- エラーメッセージの表示のためのテンプレート -->
             <?php include 'templates/err_msg.php'; ?>
             <!-- ヘッダーのテンプレート -->
             <?php include 'templates/header.php'; ?>
              
             <h3>ショッピングカート</h3>

             <?php if(count($data) !== 0 ):?>

             <artcle>
                <?php foreach($data as $book){ ?>
                <div class="cart-item">
                  <!-- 商品の情報 -->
                  <p class="img_size">
                  <img src="<?php echo h($img_dir.$book['img']); ?>">
                  </p>
                  <p><?php print h($book['book_name']) ?></p>
                  <p></p>
                   <!-- 商品の情報 -->
                
                    <!-- 商品を削除するためのform -->
                    <form action="cart.php" method='post'>
                      <p>
                      <input type="submit" value="削除">
                      <input type="hidden" name="book_id" value="<?php print h($book['book_id']); ?>">
                      <input type="hidden" name="token" value="<?php print h($token); ?>">
                      <input type="hidden" name="sql_kind" value="delete">
                      </p>
                    </form>
                    <!-- 商品を削除するためのform -->
                   
                   
                   <!-- 金額の表示 -->
                   <p>¥ <?php print h($book['price'])?></p>
                   
                   <!-- 購入数変更フォーム -->
                   <form action="cart.php" method='post'>
                     <input type="text" style="width: 30px;" name = "update_amount" value="<?php print h($book['amount']); ?>">
                     <input type="submit" value="変更する">
                     <input type="hidden" name="book_id" value="<?php print h($book['book_id']); ?>">
                     <input type="hidden" name="token" value="<?php print h($token); ?>">
                     <input type="hidden" name="sql_kind" value="update">
                   </form>
                   <!-- 購入数変更フォーム -->
                   <p>小計<?php echo h($sum = (int)$book['price'] * (int)$book['amount']) ?></p> 
             </div>
            <?php } ?> 
            </artcle>

            <h2 class="total_price">合計<?php print h($total_price); ?>円</h2>
            <div class = "buy_form">
            <form action="result.php" method="post">
                    <input type="submit" value="購入する">
                    <input type="hidden" name="book_id" value="<?php h($book['book_id']); ?>">
                    <input type="hidden" name="token" value="<?php print h($token); ?>">
                </form>
            </div>
            
             <?php 
              else:
              echo '<h2>カート内の商品はありません</h2>';
              endif;
               ?>
        </body>
</html>
<!DOCTYPE html>
    <html lang="ja">
        <head>
          <?php include 'templates/head.php'; ?>
          <link rel="stylesheet" href="./css/result.css">
          <link rel= "stylesheet" href ="./css/common.css">
          <style>
          .total_price{ text-align: center;}
          </style>
        </head>
            <body>
                <!-- エラーメッセージの表示のためのテンプレート -->
                <?php include 'templates/err_msg.php'; ?>
                <!-- ヘッダーのテンプレート -->
                <?php include 'templates/header.php'; ?>
                                
                <div class="result">
                    <?php if(count($err_msg) === 0){ ?>
                      <h1>購入完了しました</h1>
                       <?php foreach($data as $book){ ?>
                        <div class="item">
                          <p class="img_size">
                          <img src="<?php echo h($img_dir.$book['img']); ?>">
                          </p>
                          <p><?php print h($book['book_name']) ?></p>
                          <p>¥ <?php print h($book['price'])?></p>
                          <h2>
                            小計<?php echo $sum = h((int)$book['price'] * (int)$book['amount']) ?>
                          </h2>
                        </div>
                     <?php } ?>
                     <h2 class="total_price">合計<?php print h($total_price); ?>円</h2>
                   <?php } ?>
                </div>
            </body>
    </html>
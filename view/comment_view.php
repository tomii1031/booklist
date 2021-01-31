<!DOCTYPE html>
<html lang="ja">
    <head>
       <link rel="stylesheet" href="./css/comment.css">
      <link rel="stylesheet" href="./css/common.css"> 
      <?php include 'templates/head.php'; ?>
      <style>
        .paginate{ display:flex;}
        .paginate_lists{ display: flex; list-style: none;}
        .echo-page{ margin-right: 15px;}
      </style>
    </head>
        <body>
          <!-- エラーメッセージの表示のためのテンプレート -->
           <?php include 'templates/err_msg.php'; ?>
          <!-- ヘッダーのテンプレート -->
           <?php include 'templates/header.php'; ?>
                    
         <article>

           <!-- 本の情報を表示するためのdiv -->
                <div class="comment-lists">
                   <p class="img_size">
                     <img class="bookimg" src="<?php echo h($img_dir.$books[0]['img']); ?>">
                   </p>
                   <p>タイトル：<?php echo h($books[0]['book_name']);?></p>
                   <p>著者：<?php echo $books[0]['author']?></p>
                   <p>値段：<?php echo '¥'.h($books[0]['price']);?></p>
                   <p>本のジャンル：<?php echo h($book_type)?></p>
                   <p>本の状態：<?php echo h($book_status)?></p>
                </div>
           <!-- 本の情報を表示するためのdiv -->
              
                <!-- formから表示までのfieldを決めているdiv -->
                  <div class="comment-field">

                   <!-- コメントを送信するためのform-->
                   <p><?php echo h($users['user_name']).'さんのPR文'; ?></p>
                   <p><?php echo h($books[0]['promotion']); ?></p>
                      <form method="post" class="comment-post">
                        <span class="text-span">コメント：</span>
                        <input type="text" class="comment-input" name="comment">
                        <input type="submit" name="submit" value="送信">
                        <input type="hidden" name="book_id" value="<?php print h($books[0]['book_id']); ?>"></input>
                        <input type="hidden" name="user_id" value="<?php print h($user_id); ?>">
                        <input type="hidden" name ="token" value="<?php print h($token); ?>">
                        <input type="hidden" name="sql_kind" value="insert"> 
                      </form>
                    <!-- コメントを送信するためのform-->
                      
                    <!-- 入力されたコメントを表示するためのsection -->
                    <?php foreach($comments as $c): ?>
                    <?php if(!empty($comments)){ ?>
                    <section>
                       <p class="echo-comment"><?php echo h($c['user_name']) ; ?>さん :
                         <span class="user-comment"><?php echo h($c['comment']); ?></span>
                       </p>
                       <?php if($c['user_id'] === $_SESSION['user_id']): ?>
                       <!-- コメントを削除するためのform -->
                          <form method="POST" class="reply-form">
                              <input type="submit" value="削除">
                              <input type="hidden" name= "comment_id" value="<?php echo h($c['comment_id']); ?>">
                              <input type="hidden" name= "user_id" value="<?php echo h($c['user_id']); ?>">
                              <input type="hidden" name="book_id" value="<?php print h($books[0]['book_id']); ?>">
                              <input type="hidden" name ="token" value="<?php print h($token); ?>">
                              <input type="hidden" name ="sql_kind" value="delete_form">
                          </form>
                        <?php endif; ?>
                          <!-- コメントを削除するためのform -->
                       <?php } ?>
                    </section>
                    <?php endforeach; ?>
                     <!-- 入力されたコメントを表示するためのsection -->
                      
                     <!-- ページネーション -->
                      <div class="paginate">
                        <ul class="paginate_lists">
                          <?php for($i=1; $i <= $max_page; $i++): ?>
                            <li class="echo-page"><a class="page-link" href="./comment.php?page=<?php echo h($i);?>&book_id=<?php print h($books[0]['book_id']); ?>"><?php echo h($i); ?></a></li>
                          <?php endfor; ?>
                        </ul>
                      </div>
                      <!-- ページネーション -->
                      
                      <!-- カートに入れるform -->
                      <form action="index.php" method="post">
                        <?php if($books[0]['stock'] <= 0): ?>
                          <p style="color:red;">売り切れです</p>
                        <?php else : ?>
                          <input type="submit" value="カートに入れる">
                          <input type="hidden" name="book_id" value="<?php echo h($books[0]['book_id']); ?>">
                          <input type="hidden" name= "amount" value="1">
                          <input type="hidden" name ="token" value="<?php print h($token); ?>">
                          <input type="hidden" name="sql_kind" value="insert">
                        <?php endif; ?>
                      </form>
                    <!-- カートに入れるform -->
                 </div>
                 <!-- formから表示までのfieldを決めているdiv -->
        </article>
        <a href="index.php">一覧表示にもどる</a>
       <!--foreachここまで------>
    </body>
</html>
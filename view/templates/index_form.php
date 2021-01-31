<?php if((int)$book['status'] === 1){?>
   <div class="book_items">
    <p class="img_size">
      <a href="comment.php?page=1&book_id=<?php print h($book['book_id']);?>">
      <img class="bookimg" src="<?php echo $img_dir.$book['img']; ?>">
      </a>
    </p>
    <div class="info">
      <p>タイトル：<?php echo h($book['book_name']);?></p>
      <p>値段：<?php echo '¥'.h($book['price']);?></p>
      <!-- 商品をカートに入れるform -->
      <form action="index.php" method="post">
        <?php if($book['stock'] <= 0): ?>
          <p style="color:red;">売り切れです</p>
        <?php else : ?>
          <input type="submit" value="カートに入れる">
          <input type="hidden" name="book_id" value="<?php echo h($book['book_id']); ?>">
          <input type="hidden" name="user_id" value="<?php echo h($user_id); ?>">
          <input type="hidden" name= "amount" value="1">
          <input type="hidden"  name="token" value="<?php print h($token); ?>">
          <input type="hidden" name="sql_kind" value="insert">
        <?php endif; ?>
      </form>
       <!-- 商品をカートに入れるform -->

       <!-- 商品にコメントするform -->
      <form class="comment-form" action="comment.php" method="POST">
          <input type="submit" value="コメントする">
          <input type="hidden" name="book_id" value="<?php echo h($book['book_id']); ?>">
      </form> 
       <!-- 商品にコメントするform -->

    </div>
  </div>
<?php } ?>
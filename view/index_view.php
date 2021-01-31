<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include 'templates/head.php'; ?>
  <title>商品一覧表示</title>
  <link rel= "stylesheet" href ="./css/index.css">
  <link rel= "stylesheet" href ="./css/common.css">
  <style>
    .paginate{display:flex; width: 1000px;}
    .paginate_lists{display: flex; list-style: none; margin: 0 auto;}
    .echo-page{ margin-right: 15px; margin-bottom: 10px;}
    .page-link{ color: black; font-size: 20px;}
  </style>
</head>
<body>
  
    <!-- エラーメッセージの表示のためのテンプレート -->
    <?php include 'templates/err_msg.php'; ?>
    <!-- ヘッダーのテンプレート -->
    <?php include 'templates/header.php'; ?>
    
   <!--本の状態で検索する-->
   <form class= "select-book" action = 'index.php' method = 'POST'>
       <p>本の状態で検索する</p>
       <select name = "book_status">
            <option value="0">汚れている</option>
            <option value="1">やや汚れている</option>
            <option value="2">傷や汚れはない</option>
            <option value="3">ほぼ未使用</option>
            <option value="4">未使用</option>
        </select>
        <input type="submit" value = "検索する">
        <input type="hidden"  name = "token" value="<?php print h($token); ?>">
        <input type="hidden" name = "sql_kind" value = "select">
   </form>
   
   <?php if ($sql_kind === 'select'){ ?>
     <h2><?php print $book_select.'の商品はこちら'?></h2>
       <div class= "book_lists">
          <?php if(empty($selects)):?>
            <h2>該当する商品は現在ありません</h2>
          <?php endif; ?>
          <?php foreach($selects as $book){ ?> 
            <?php include 'templates/index_form.php'; ?>    
          <?php } ?>
       </div>
   <?php } ?> 
      <!----本の状態で検索する--selectここまで-->
      
    <!--本のタイプで検索する-->
   <form class= "select-book" action = 'index.php' method = 'POST'>
       <p>本の種類で検索する</p>
       <select name = "book_info">
            <option value="0">ビジネス書、経済・経営</option>
            <option value="1">実用書</option>
            <option value="2">小説</option>
            <option value="3">自然や健康</option>
        </select>
        <input type="submit" value = "検索する">
        <input type="hidden"  name = "token" value="<?php print h($token); ?>">
        <input type="hidden" name = "sql_kind" value = "book_type">
   </form>
   
   <?php if ($sql_kind === 'book_type'){ ?>
     <h2><?php print $book_type.'の商品はこちら'?></h2>
       <div class= "book_lists">
          <?php if(empty($types)):?>
            <h2>該当する商品は現在ありません</h2>
          <?php endif; ?>
          <?php foreach($types as $book){ ?>
            <?php include 'templates/index_form.php'; ?>      
          <?php } ?>
       </div>
    <?php } ?>
<!--本のタイプで検索するここまで-------->

    <h2>新着のおすすめ書籍はこちら</h2>
    <div class="recommend">
        <div class= "book_lists">
            <?php foreach($recommend as $book){ ?>    
              <?php include 'templates/index_form.php'; ?>   
            <?php } ?>
        </div>
    </div>
   
    <article class="index">   
      <h2>全商品一覧</h2>
        <div class= "book_lists">
          <?php foreach($data as $book){ ?>
            <?php include 'templates/index_form.php'; ?>
          <?php } ?>  
        </div>
        <!-- ページネーション -->
        <div class="paginate">
          <ul class="paginate_lists">
            <?php for($i=1; $i <= $max_page; $i++): ?>
              <li class="echo-page"><a class="page-link" href="./index.php?page=<?php echo h($i);?>"><?php echo h($i); ?></a></li>     
            <?php endfor; ?>
          </ul>
        </div>
        <!-- ページネーション --> 
    </article>
  </body>
</html>
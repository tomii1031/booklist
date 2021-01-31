<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include 'templates/head.php'; ?>
  <title>本販売システム</title>
  <style>
    table {width: 960px;border-collapse: collapse;}
    table, tr, th, td{border: solid 1px; padding: 10px; text-align: center;}
    img { width: 270px;  height: 200px;}
  </style>
  <link rel= "stylesheet" href ="./css/common.css">
</head>
<body>
    <!-- エラーメッセージの表示のためのテンプレート -->
    <?php include 'templates/err_msg.php'; ?>
    <!-- ヘッダーのテンプレート -->
    <?php include 'templates/header.php'; ?>
    <h1>BOOK販売ツール</h1>
        <hr>
    <h2>新規本の追加</h2>
    <form action="tool.php" method="POST" enctype="multipart/form-data">
        <P>名前：
            <input type="text" name="book_name"></P>
        <p>値段：
            <input type="text" name="price"></P>
            
        <p>個数：
            <input type="text" name = "stock"></p>
        <p>著者：
        <input type="text" name = "author"></p>
        <p>この本をおすすめしたい人</p>
        <textarea name="promotion" cols="40" rows="4" placeholder="商品の状態や、ご自身が読んだ感想など、PRしたいことなどをご記入ください"></textarea>
        <p>本のジャンル</p>
        <select name = "book_info">
            <option value="0">ビジネス書、経済・経営</option>
            <option value="1">実用書</option>
            <option value="2">小説</option>
            <option value="3">自然や健康</option>
        </select>
        <p>出品する本の状態</p>
        <select name = "book_status">
            <option value="0">汚れている</option>
            <option value="1">やや汚れている</option>
            <option value="2">傷や汚れはない</option>
            <option value="3">ほぼ未使用</option>
            <option value="4">未使用</option>
        </select>
        <p>
        <select name="status">
            <option value="0">非公開</option>
            <option value="1">公開</option>
        </select>
        </p>
        <p> <input type="file" name ="img_file"></p>
        <p> <input type="submit" value="商品を追加"></p>
        <input type="hidden"  name = "token" value="<?php print h($token); ?>">
        <input type="hidden" name="sql_kind" value="insert">
    </form>
    <table>
        <tr>
            <th class="book_img">商品画像</th>
            <th class="book_name">商品名</th>
            <th>価格</th>
            <th>本の状態</th>
            <th>PR文</th>
            <th>本のジャンル</th>
            <th>在庫数</th>
            <th>ステータス</th>
            <th>操作</th>
        </tr>
        
            <?php foreach($books as $book){ ?>
        <tr>
            
            <td><img src="<?php echo h($img_dir.$book['img']); ?>"></td>
            <td><?php echo h($book['book_name']); ?></td>
            <td><?php echo h($book['price']); ?></td>
            <td><?php echo h($book_status); ?></td>
            <td> 
                 <form method="post">
                    <textarea name="promotion" cols="40" rows="4"><?php print h($book['promotion']);?></textarea>
                    <input type="submit" value="変更する">
                    <input type="hidden" name="book_id" value="<?php print h($book['book_id']); ?>">
                    <input type="hidden"  name = "token" value="<?php print h($token); ?>">
                    <input type="hidden" name="sql_kind" value="update_promotion">
                 </form>
             </td>
            <td><?php echo h($book_type); ?></td>

            <td>
            <form method="post">
                 <input type="text" style="width: 30px;" name = "update_stock" value="<?php print h($book['stock']); ?>">
                 <input type="submit" value="変更する">
                 <input type="hidden" name="book_id" value="<?php print h($book['book_id']); ?>">
                 <input type="hidden"  name = "token" value="<?php print h($token); ?>">
                 <input type="hidden" name="sql_kind" value="update">
             </form>
            </td>
          
            <form method="post">
            <?php if ($book['status'] === 1) { ?>
                    <td><input type="submit" value="公開 → 非公開"></td>
                    <input type="hidden" name="change_status" value="0">
            <?php } else { ?>
                    <td><input type="submit" value="非公開 → 公開"></td>
                    <input type="hidden" name="change_status" value="1">
            <?php } ?>
                    <input type="hidden" name="book_id" value="<?php print h($book['book_id']); ?>">
                    <input type="hidden"  name = "token" value="<?php print h($token); ?>">
                    <input type="hidden" name="sql_kind" value="change">
            </form>
            
            <td>
                <form method = "post">
                <input type="submit" value="削除する">
                <input type="hidden" name="book_id" value="<?php print h($book['book_id'])?>">
                <input type="hidden"  name = "token" value="<?php print h($token); ?>">
                <input type="hidden" name="sql_kind" value="delete">
                </form>
            </td>
            
        </tr>
             <?php } ?>
    
    </table>    
  </body>
</html>

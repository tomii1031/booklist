<header>
   <h1 class="header-title"><a href="index.php">BOOKList</a></h1>
      <div class="header-left">
        <?php if($_SESSION['user_id'] !== null): ?>
        <a class="tool" href ="tool.php">出品</a>
        <a class="cartimg" href="cart.php"><img class="cart" src="./contents/cart.png"></a>
        <a class="logout" href="logout.php"><input type="submit" value="ログアウトする"></a>
        <?php endif; ?>
      </div>
</header>
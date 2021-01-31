<?php


define('DB_HOST', 'mysql');
define('DB_NAME', 'sample');
define('DB_USER', 'testuser');
define('DB_PASS', 'password');
define('DB_CHARSET', 'utf8');


define('IMAGE_DIR', './img/');



define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../model/');
define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../view/');


define('REGISTER_URL', '/register.php');
define('LOGIN_URL', '/login.php');
define('LOGOUT_URL', '/logout.php');
define('HOME_URL', '/index.php');
define('CART_URL', '/cart.php');
define('RESULT_URL', '/result.php');
define('TOOL_URL', '/tool.php');


define('BOOK_KIND', array(
  "0" => "ビジネス、経済・経営",
  "1" => "実用書",
  "2" => "小説",
  "3" => "自然と健康"
));

define('BOOK_SELECTS', array(
  "0" => "汚れている",
  "1" => "やや汚れている",
  "2" => "傷や汚れはない",
  "3" => "ほぼ未使用",
  "4" => "未使用"
));














?>




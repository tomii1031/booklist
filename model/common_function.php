<?php

//var_dump
function dd($var){
  var_dump($var);
  exit();
}


//xss対策
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


function get_get($name){
  if(isset($_GET[$name]) === true){
    return $_GET[$name];
  };
  return '';
}


function get_post($name){
  if(isset($_POST[$name]) === true){
    return $_POST[$name];
  };
  return '';
}


function get_session($name){
  if(isset($_SESSION[$name]) === true){
    return $_SESSION[$name];
  };
  return '';
}

function set_session($name, $value){
  $_SESSION[$name] = $value;
}

function get_random_string($length = 20){
  return substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, $length);
}

// トークンの生成
function get_csrf_token(){
  $token = get_random_string(30);
  
  set_session('csrf_token', $token);
  return $token;
}

// トークンのチェック
function is_valid_csrf_token($token){
  if($token === '') {
    return false;
  }
  // get_session()はユーザー定義関数
  return $token === get_session('csrf_token');
}


function redirect_to($url){
  header('Location: ' . $url);
  exit;
}










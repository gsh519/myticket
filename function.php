<?php
// データーベース接続関数
function dbConnect($db_name, $db_host, $db_user, $db_pass)
{
  // データーベースに接続
  try {
    $option = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
    ];
    $pdo = new PDO("mysql:charset=UTF8;dbname=$db_name;host=$db_host", $db_user, $db_pass, $option);
    return $pdo;
  } catch (PDOException $e) {
    $errors[] = $e->getMessage();
  }
}

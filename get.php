<?php

//初期値
$errors = [];

$ticket_id = $_GET['ticket_id'];
$submit = $_GET['submit'];

if (!empty($submit)) {
  if (empty($ticket_id)) {
    $errors[] = 'チケットIDを入力してください';
  }

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

  $pdo = dbConnect("myticket", "localhost", "root", "root");

  //sql文作成
  $sql = "SELECT * FROM ticket WHERE id = :ticket_id";

  $stmt = $pdo->prepare($sql);

  //値のセット
  $stmt->bindParam(':ticket_id', $ticket_id, PDO::PARAM_STR);

  //実行
  $stmt->execute();

  //データの取得
  $ticket_data = $stmt->fetch();

  if (!empty($ticket_data)) {
    header("Location: ./question.php?ticket_id=$ticket_id");
  } else {
    $errors[] = 'チケットIDが間違えています';
  }
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>チケットをもらう</title>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>

<body>
  <div class="wrapper">
    <div class="logo logo--get"><a href="./">myticket</a></div>
    <div class="ticketid">
      <h1 class="title">
        <i class="fas fa-gift"></i>
        チケットをもらう
      </h1>

      <div class="ticketid-form">
        <h2>チケットIDを入力してね！</h2>
        <form action="" method="GET">
          <div class="ticketid-form__area">
            <label for="ticket_id">チケットID</label>
            <input type="text" id="ticket_id" name="ticket_id" class="ticket_id" placeholder="fanrgargjaf">
          </div>
          <?php if (!empty($errors)) : ?>
            <ul class="ticketid-form__area">
              <?php foreach ($errors as $error) : ?>
                <li class="error"><?php echo $error; ?></li>
              <?php endforeach ?>
            </ul>
          <?php endif ?>
          <div class="ticketid-form__area ticketid-form__area--right">
            <input type="submit" class="submit" name="submit" value="送信">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>

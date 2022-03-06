<?php
require("function.php");
require('./entities/ticket.php');
require('./entities/question.php');

$ticket = new Ticket();
$question = new Question();
$errors = [];
$user_answers = [];
$ticket->ticket_id = $_GET['ticket_id'];

// ユーザーの回答をセット
if ($_POST) {
  $user_answers[] = $_POST;
}


if (!empty($ticket->ticket_id)) {
  $pdo = dbConnect("myticket", "localhost", "root", "root");
  $sql = "SELECT * FROM question WHERE ticket_id = :ticket_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":ticket_id", $ticket->ticket_id, PDO::PARAM_STR);
  $stmt->execute();
  $question->questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (!$question->questions) {
    $errors[] = '質問を取得できませんでした';
  }

  // 正しい回答をセット
  foreach ($question->questions as $value) {
    $question->answers[] = $value['answer'];
  }

  // 1.採点するを押したら回答をチェック
  if ($user_answers) {
    // 回答をチェック
    $is_true = $question->checkAnswer($user_answers);
  }

  // 3.その回答があっている割合によって表示する内容を変更

} else {
  $errors[] = 'チケットIDを取得できません';
}

require('./views/get_question.view.php');

<?php
require_once("./function.php");
require("./entities/ticket.php");

$ticket = new Ticket();

//初期値
$errors = [];
if (!empty($_GET)) {
  $ticket->ticket_id = $_GET['ticket_id'];
  $submit = $_GET['submit'];
}


if (!empty($submit)) {
  if (empty($ticket->ticket_id)) {
    $errors[] = 'チケットIDを入力してください';
  }

  // データ取得
  $pdo = dbConnect("myticket", "localhost", "root", "root");
  $select_sql = "SELECT * FROM ticket WHERE id = :ticket_id";
  $stmt = $pdo->prepare($select_sql);
  $stmt->bindParam(':ticket_id', $ticket->ticket_id, PDO::PARAM_STR);
  $stmt->execute();
  $ticket_data = $stmt->fetch();

  if (isset($ticket_data)) {
    header("Location: ./get_question.php?ticket_id={$ticket->ticket_id}");
    exit;
  } else {
    $errors[] = 'チケットIDが間違えています';
  }
}

require('./views/get.view.php');

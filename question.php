<?php
require_once("function.php");
$errors = [];
$ticket_id = $_GET['ticket_id'];
if (!empty($ticket_id)) {
  //db接続
  $pdo = dbConnect("myticket", "localhost", "root", "root");

  //sql文作成
  $sql = "SELECT * FROM question WHERE ticket_id = :ticket_id";

  $stmt = $pdo->prepare($sql);

  //値のセット
  $stmt->bindParam(":ticket_id", $ticket_id, PDO::PARAM_STR);

  //実行
  $stmt->execute();

  //データの取得
  $questions = $stmt->fetchAll();

  $stmt = null;
  $pdo = null;
} else {
  $errors[] = 'チケットIDを取得できません';
}

if ($_POST) {
  while ($number < count($questions)) {
    $number += 1;

    $_POST['answer' . $number];
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
    <div class="question-start">
      <h1>ゆうとがあなたに向けて<br>作ったクイズです!</h1>
    </div>

    <p class="question-ttl">クイズを解いてチケットをもらおう!</p>
    <form action="" method="POST">
      <div class="questions">
        <ul>
          <?php if (!empty($questions)) : ?>
            <?php foreach ($questions as $number => $question) : ?>
              <li class="questions__item">
                <p class="question-number"><span><?php echo $number + 1; ?></span>問目</p>
                <h2 class="question-subject"><?php echo $question['subject']; ?></h2>
                <p class="question-comm">正解だと思うものを１つ選んでください</p>
                <div class="select-area">
                  <label for="answer_1<?php echo $number; ?>">
                    <input type="radio" class="select-box" name="answer<?php echo $number; ?>" value="<?php echo $question['answer_list1']; ?>" id="answer_1<?php echo $number; ?>">
                    <p><?php echo $question['answer_list1']; ?></p>
                  </label>
                </div>
                <div class="select-area">
                  <label for="answer_2<?php echo $number; ?>">
                    <input type="radio" class="select-box" name="answer<?php echo $number; ?>" value="<?php echo $question['answer_list2']; ?>" id="answer_2<?php echo $number; ?>">
                    <p><?php echo $question['answer_list2']; ?></p>
                  </label>
                </div>
                <div class="select-area">
                  <label for="answer_3<?php echo $number; ?>">
                    <input type="radio" class="select-box" name="answer<?php echo $number; ?>" value="<?php echo $question['answer_list3']; ?>" id="answer_3<?php echo $number; ?>">
                    <p><?php echo $question['answer_list3']; ?></p>
                  </label>
                </div>
              </li>
            <?php endforeach; ?>
          <?php endif; ?>

          <!-- <li class="questions__item">
          <p class="question-number"><span>1</span>問目</p>
          <h2 class="question-subject">悠斗と芽衣が付き合った日にちはいつでしょう？</h2>
          <p class="question-comm">正解だと思うものを１つ選んでください</p>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>11月12日</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>10月12日</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>12月13日</p>
            </label>
          </div>
        </li>

        <li class="questions__item">
          <p class="question-number"><span>2</span>問目</p>
          <h2 class="question-subject">1年記念日で行った旅行先はどこでしょう？</h2>
          <p class="question-comm">正解だと思うものを１つ選んでください</p>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>淡路島</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>京都</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>大阪空庭温泉</p>
            </label>
          </div>
        </li>

        <li class="questions__item">
          <p class="question-number"><span>3</span>問目</p>
          <h2 class="question-subject">悠斗は何人家族でしょう？</h2>
          <p class="question-comm">正解だと思うものを１つ選んでください</p>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>3人家族</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>5人家族</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>4人家族</p>
            </label>
          </div>
        </li>

        <li class="questions__item">
          <p class="question-number"><span>4</span>問目</p>
          <h2 class="question-subject">悠斗と芽衣はどこで出会ったでしょう？</h2>
          <p class="question-comm">正解だと思うものを１つ選んでください</p>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>ナンパ</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>友人の紹介</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>映画館のバイト</p>
            </label>
          </div>
        </li>

        <li class="questions__item">
          <p class="question-number"><span>5</span>問目</p>
          <h2 class="question-subject">初めて行った旅行先はどこでしょう？</h2>
          <p class="question-comm">正解だと思うものを１つ選んでください</p>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>京都旅行</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>長島スパーランド</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>東京</p>
            </label>
          </div>
        </li> -->

          <input type="submit" name="check" value="採点する" class="check">
        </ul>
      </div>
    </form>

    <!-- <div class="answer">
      <h2>5問中 <span>5問正解！</span></h2>
      <ul class="answer__list">
        <li>1問目：◯</li>
        <li>2問目：◯</li>
        <li>3問目：◯</li>
        <li>4問目：◯</li>
        <li>5問目：◯</li>
        <li>6問目：◯</li>
      </ul>
      <p class="answer__comm">おめでとうございます！<br>チケットを受け取ることができます！！</p>
      <a href="./ticket.php" class="ticket-get"><i class="fas fa-gift"></i>チケットをもらう！！</a>
    </div> -->
  </div>
</body>

</html>

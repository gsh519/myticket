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
  <script src="./js/script.js" defer></script>
</head>

<body>
  <div class="wrapper">
    <div class="logo logo--get"><a href="./">myticket</a></div>
    <div class="question-start">
      <h1>ゆうとがあなたに向けて<br>作ったクイズです!</h1>
    </div>

    <p class="question-ttl">クイズを解いてチケットをもらおう!</p>
    <!-- エラー文表示 -->
    <?php if (isset($errors)) : ?>
      <ul class="ticketid-form__area">
        <?php foreach ($errors as $error) : ?>
          <li class="error"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></li>
        <?php endforeach ?>
      </ul>
    <?php endif ?>
    <form action="" method="POST">
      <div class="questions">

        <?php if (isset($questions)) : ?>
          <ul>
            <?php foreach ($questions as $index => $question) : ?>
              <li class="questions__item">
                <p class="question-number"><span><?php echo $index + 1; ?></span>問目</p>
                <h2 class="question-subject"><?php echo $question['subject']; ?></h2>
                <p class="question-comm">正解だと思うものを１つ選んでください</p>

                <div class="select-area">
                  <label for="answer_1<?php echo $index; ?>">
                    <input required type="radio" class="select-box" name="answer<?php echo $index; ?>" value="<?php echo $question['answer_list1']; ?>" id="answer_1<?php echo $index; ?>">
                    <p><?php echo $question['answer_list1']; ?></p>
                  </label>
                </div>

                <div class="select-area">
                  <label for="answer_2<?php echo $index; ?>">
                    <input required type="radio" class="select-box" name="answer<?php echo $index; ?>" value="<?php echo $question['answer_list2']; ?>" id="answer_2<?php echo $index; ?>">
                    <p><?php echo $question['answer_list2']; ?></p>
                  </label>
                </div>

                <div class="select-area">
                  <label for="answer_3<?php echo $index; ?>">
                    <input required type="radio" class="select-box" name="answer<?php echo $index; ?>" value="<?php echo $question['answer_list3']; ?>" id="answer_3<?php echo $index; ?>">
                    <p><?php echo $question['answer_list3']; ?></p>
                  </label>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php if (isset($is_true)) : ?>
          <ul>
            <?php foreach ($is_true as $answer) : ?>
              <li><?php echo $answer; ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>

      <button class="check" type="submit">採点する</button>
    </form>

    <!-- 正解数によって表示内容を変える -->
    <div class="answer" id="answer-area">
      <!-- 文言変更 -->
      <h2><span>全問正解！</span></h2>
      <p class="answer__comm">おめでとうございます！<br>チケットを受け取ることができます！！</p>
      <a href="./get_ticket.php" class="ticket-get"><i class="fas fa-gift"></i>チケットをもらう！！</a>
    </div>
  </div>
</body>

</html>

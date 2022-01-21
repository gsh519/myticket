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

    <p class="question-ttl">クイズを解いてチケットをもらう</p>
    <div class="questions">
      <ul>

        <li class="questions__item">
          <p class="question-number"><span>1</span>問目</p>
          <h2 class="question-subject">苦手な果物</h2>
          <p class="question-comm">正解だと思うものを１つ選んでください</p>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>いちご</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>いちご</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>いちご</p>
            </label>
          </div>
        </li>

        <li class="questions__item">
          <p class="question-number"><span>1</span>問目</p>
          <h2 class="question-subject">苦手な果物</h2>
          <p class="question-comm">正解だと思うものを１つ選んでください</p>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>いちご</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>いちご</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>いちご</p>
            </label>
          </div>
        </li>

        <li class="questions__item">
          <p class="question-number"><span>1</span>問目</p>
          <h2 class="question-subject">苦手な果物</h2>
          <p class="question-comm">正解だと思うものを１つ選んでください</p>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>いちご</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>いちご</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>いちご</p>
            </label>
          </div>
        </li>

        <li class="questions__item">
          <p class="question-number"><span>1</span>問目</p>
          <h2 class="question-subject">苦手な果物</h2>
          <p class="question-comm">正解だと思うものを１つ選んでください</p>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>いちご</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>いちご</p>
            </label>
          </div>
          <div class="select-area">
            <label for="answer_1">
              <input type="radio" class="select-box" name="answer_1" value="いちご" id="answer_1">
              <p>いちご</p>
            </label>
          </div>
        </li>

        <input type="submit" name="check" value="採点する" class="check">
      </ul>
    </div>

    <div class="answer">
      <h2>10問中 <span>5問正解！</span></h2>
      <ul class="answer__list">
        <li>1問目：◯</li>
        <li>1問目：◯</li>
        <li>1問目：◯</li>
        <li>1問目：◯</li>
        <li>1問目：◯</li>
        <li>1問目：◯</li>
        <li>1問目：◯</li>
        <li>1問目：◯</li>
        <li>1問目：◯</li>
        <li>1問目：◯</li>
      </ul>
      <p>おめでとうございます！<br>チケットを受け取ることができます！！</p>
      <a href="./ticket.php" class="ticket-get"><i class="fas fa-gift"></i>チケットをもらう！！</a>
    </div>
  </div>
</body>

</html>

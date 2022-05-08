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
            <!-- <h1>ゆうとがあなたに向けて<br>作ったクイズです!</h1> -->
        </div>

        <p class="question-ttl">クイズを解いて<br>チケットをもらおう!</p>
        <!-- エラー文表示 -->
        <ul class="ticketid-form__area">
            <?php foreach ($this->errors as $error) : ?>
                <li class="error"><?php $this->escape($error); ?></li>
            <?php endforeach ?>
        </ul>
        <form class="form" action="" method="POST">
            <div class="questions">

                <?php if (isset($question->questions)) : ?>
                    <ul>
                        <?php foreach ($question->questions as $index => $question) : ?>

                            <!-- これが一つの問題 -->
                            <li class="questions__item">
                                <p class="question-number"><span><?php echo $index + 1; ?></span>問目</p>
                                <h2 class="question-subject"><?php echo $question['subject']; ?></h2>
                                <p class="question-comm">正解だと思うものを１つ選んでください</p>

                                <div class="select-area">
                                    <label for="answer_1<?php echo $index; ?>">
                                        <input required type="radio" class="select-box" name="answer<?php echo $index; ?>" value="<?php echo $question['answer_list1']; ?>" id="answer_1<?php echo $index; ?>" <?php if ($user_answers && $question['answer_list1'] === $user_answers[0]['answer' . $index]) {
                                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                                } ?>>
                                        <p><?php echo $question['answer_list1']; ?></p>
                                    </label>
                                </div>

                                <div class="select-area">
                                    <label for="answer_2<?php echo $index; ?>">
                                        <input required type="radio" class="select-box" name="answer<?php echo $index; ?>" value="<?php echo $question['answer_list2']; ?>" id="answer_2<?php echo $index; ?>" <?php if ($user_answers && $question['answer_list2'] === $user_answers[0]['answer' . $index]) {
                                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                                } ?>>
                                        <p><?php echo $question['answer_list2']; ?></p>
                                    </label>
                                </div>

                                <div class="select-area">
                                    <label for="answer_3<?php echo $index; ?>">
                                        <input required type="radio" class="select-box" name="answer<?php echo $index; ?>" value="<?php echo $question['answer_list3']; ?>" id="answer_3<?php echo $index; ?>" <?php if ($user_answers && $question['answer_list2'] === $user_answers[0]['answer' . $index]) {
                                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                                } ?>>
                                        <p><?php echo $question['answer_list3']; ?></p>
                                    </label>
                                </div>

                                <?php if (isset($is_true)) : ?>
                                    <p class="answer-tag"><?php echo $is_true[$index]; ?></p>
                                <?php endif; ?>
                            </li>

                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

            </div>

            <button class="check" type="submit" id="check-btn">採点する</button>
        </form>

        <!-- 正解数によって表示内容を変える -->
        <?php if ($_POST) : ?>

            <div class="answer" id="answer-area">
                <h2><span><?php echo $percent; ?></span></h2>
                <p class="answer__comm"><?php echo $comment; ?></p>
                <?php if ($ticket_link) : ?>
                    <a href="./get_ticket.php?ticket_key=<?php $this->escape($ticket->ticket_key); ?>" class="ticket-get"><i class="fas fa-gift"></i>チケットをもらう！！</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="../js/script.js"></script>
</body>

</html>

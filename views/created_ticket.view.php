<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自分チケット</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>

<body>
    <div class="wrapper ticket-frame">
        <div class="logo logo--get"><a href="./">myticket</a></div>

        <!-- 成功メッセージ表示 -->
        <?php if (!empty($_SESSION['msg'])) : ?>
            <p class="message"><?php $this->escape($_SESSION['msg']); ?></p>
            <?php unset($_SESSION['msg']); ?>
        <?php endif; ?>

        <!-- エラー表示 -->
        <ul>
            <?php foreach ($this->errors as $error) : ?>
                <li><?php $this->escape($error); ?></li>
            <?php endforeach; ?>
        </ul>
        <p class="info">チケットやクイズはいつでも変更できます！</p>

        <!-- チケット画像表示 -->
        <div class="ticket-img fadeIn">
            <img src="<?php echo $this->escape($this->ticket['image_path']); ?>" alt="チケット画像">
        </div>

        <!-- チケットコメント表示 -->
        <p class="ticket_comment-info"><?php $this->escape($this->ticket['ticket_comment']); ?></p>

        <!-- クイズ表示 -->
        <?php if (isset($this->questions)) : ?>
            <ul class="quiz-list">
                <?php foreach ($this->questions as $index => $question) : ?>

                    <!-- これが一つの問題 -->
                    <li class="questions__item">
                        <p class="question-number"><span><?php echo $index + 1; ?></span>問目</p>
                        <h2 class="question-subject"><?php echo $question['subject']; ?></h2>
                        <p class="question-comm">正解だと思うものを１つ選んでください</p>

                        <div class="select-area">
                            <label for="answer_1<?php echo $index; ?>">
                                <input required type="radio" class="select-box" name="answer<?php echo $index; ?>" value="" id="answer_1<?php echo $index; ?>">
                                <p><?php echo $question['answer_list1']; ?></p>
                            </label>
                        </div>

                        <div class="select-area">
                            <label for="answer_2<?php echo $index; ?>">
                                <input required type="radio" class="select-box" name="answer<?php echo $index; ?>" value="" id="answer_2<?php echo $index; ?>">
                                <p><?php echo $question['answer_list2']; ?></p>
                            </label>
                        </div>

                        <div class="select-area">
                            <label for="answer_3<?php echo $index; ?>">
                                <input required type="radio" class="select-box" name="answer<?php echo $index; ?>" value="" id="answer_3<?php echo $index; ?>">
                                <p><?php echo $question['answer_list3']; ?></p>
                            </label>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>


        <a href="#" class="ticket-link ticket-link--store">修正する</a>
        <a href="/" class="ticket-link">Home</a>
    </div>
</body>

</html>

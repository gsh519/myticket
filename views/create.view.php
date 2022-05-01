<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チケットをもらう</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.min.css">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> -->

    <script src="../js/script.js" defer></script>
</head>

<body>
    <div class="wrapper">
        <div class="logo logo--get"><a href="./">myticket</a></div>
        <div class="ticketid">
            <h1 class="title">
                <i class="fas fa-gift"></i>
                チケットを作る！
            </h1>

            <div class="ticketid-form">
                <h2>チケットをつくろう</h2>

                <!-- 成功メッセージ表示 -->
                <?php if (isset($_SESSION['msg'])) : ?>
                    <p class="message"><?php $this->escape($_SESSION['msg']); ?></p>
                    <?php unset($_SESSION['msg']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['login_success'])) : ?>
                    <p class="message"><?php $this->escape($_SESSION['login_success']); ?></p>
                    <?php unset($_SESSION['login_success']); ?>
                <?php endif; ?>

                <!-- エラー表示 -->
                <ul>
                    <?php if (!empty($ticket->errors)) : ?>
                        <?php foreach ($ticket->errors as $error) : ?>
                            <li><?php $this->escape($error); ?></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <ul>
                    <?php foreach ($this->errors as $error) : ?>
                        <li><?php $this->escape($error); ?></li>
                    <?php endforeach; ?>
                </ul>

                <form action="" method="post" enctype="multipart/form-data">

                    <!-- 画像 -->
                    <div class="ticketid-form__area img-form">
                        <label for="ticket_img">
                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
                            <input accept="image/*" type="file" id="ticket_img" name="ticket_img">チケット画像を選択
                        </label>
                        <div class="preview">
                            <img src="" id="preview_img">
                        </div>
                    </div>

                    <!-- コメント -->
                    <div class="ticketid-form__area">
                        <label for="ticket_comment">チケットにつけるコメント</label>
                        <input value="<?php $this->escape($ticket->ticket_comment); ?>" type="text" id="ticket_comment" name="ticket_comment" class="ticket_id" placeholder="fanrgargjaf">
                    </div>

                    <!-- クイズ作成 -->
                    <h2>クイズを作成</h2>
                    <div id="js_ticket-quiz">
                        <!-- ここから -->
                        <?php
                        if (!empty($questions->questions)) :
                            foreach ($questions->questions as $index => $question) :
                        ?>
                                <div class="ticketid-form__area ticketid-form__area--question">
                                    <label for="subject">クイズ<?php $this->escape($index + 1); ?></label>
                                    <input value="<?php $this->escape($question['subject']); ?>" required type="text" id="subject" name="questions[<?php $this->escape($index); ?>][subject]" class="ticket_id ticket_question_form" placeholder="悠斗の誕生日は？">

                                    <label for="answer_list1">答え選択肢</label>
                                    <input value="<?php $this->escape($question['answer_list1']); ?>" required type="text" name="questions[<?php $this->escape($index); ?>][answer_list1]" class="ticket_id ticket_question_form" placeholder="3月11日">
                                    <input value="<?php $this->escape($question['answer_list2']); ?>" required type="text" name="questions[<?php $this->escape($index); ?>][answer_list2]" class="ticket_id ticket_question_form" placeholder="5月19日">
                                    <input value="<?php $this->escape($question['answer_list3']); ?>" required type="text" name="questions[<?php $this->escape($index); ?>][answer_list3]" class="ticket_id ticket_question_form" placeholder="8月20日">

                                    <label for="answer">答え</label>
                                    <input value="<?php $this->escape($question['answer']); ?>" required type="text" id="answer" name="questions[<?php $this->escape($index); ?>][answer]" class="ticket_id ticket_question_form" placeholder="5月19日">
                                </div>
                            <?php
                            endforeach;
                        else :
                            ?>
                            <div class="ticketid-form__area ticketid-form__area--question">
                                <label for="subject">クイズ１</label>
                                <input required type="text" id="subject" name="questions[0][subject]" class="ticket_id ticket_question_form" placeholder="悠斗の誕生日は？">

                                <label for="answer_list1">答え選択肢</label>
                                <input required type="text" name="questions[0][answer_list1]" class="ticket_id ticket_question_form" placeholder="3月11日">
                                <input required type="text" name="questions[0][answer_list2]" class="ticket_id ticket_question_form" placeholder="5月19日">
                                <input required type="text" name="questions[0][answer_list3]" class="ticket_id ticket_question_form" placeholder="8月20日">

                                <label for="answer">答え</label>
                                <input required type="text" id="answer" name="questions[0][answer]" class="ticket_id ticket_question_form" placeholder="5月19日">
                            </div>
                        <?php endif; ?>
                        <!-- ここまで -->
                    </div>

                    <div class="btn-inner">
                        <button class="plus-btn" id="js_plus"><i class="fas fa-plus"></i>クイズを追加</button>
                    </div>

                    <!-- 作成ボタン -->
                    <div class="ticketid-form__area ticketid-form__area--right">
                        <input type="submit" class="submit" name="create" value="作成">
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>

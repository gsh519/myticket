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
                チケット編集
            </h1>

            <div class="ticketid-form">

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

                <form action="" method="post" enctype="multipart/form-data">

                    <!-- 画像 -->
                    <div class="edit-image">
                        <img src="<?php $this->escape($this->ticket['image_path']); ?>" alt="チケット画像">
                    </div>
                    <div class="ticketid-form__area">
                        <label for="ticket_img">
                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
                            <input accept="image/*" type="file" id="ticket_img" name="ticket_img">チケット画像を選択
                        </label>
                    </div>

                    <!-- コメント -->
                    <div class="ticketid-form__area">
                        <label for="ticket_comment">チケットにつけるコメント</label>
                        <input type="text" id="ticket_comment" name="ticket_comment" class="ticket_id" placeholder="fanrgargjaf" value="<?php $this->escape($this->ticket['ticket_comment']) ?>">
                    </div>

                    <!-- クイズ作成 -->
                    <h2>クイズを編集</h2>

                    <?php if (isset($this->questions)) : ?>
                        <?php foreach ($this->questions as $i => $question) : ?>
                            <div class="ticketid-form__area ticketid-form__area--question">
                                <label for="subject">クイズ<?php $this->escape($i + 1); ?></label>
                                <input type="text" id="subject" name="questions[<?php $this->escape($i); ?>][subject]" class="ticket_id ticket_question_form" value="<?php $this->escape($question['subject']) ?>">

                                <label for="answer_list1">答え選択肢</label>
                                <input type="text" name="questions[<?php $this->escape($i); ?>][answer_list1]" class="ticket_id ticket_question_form" value="<?php $this->escape($question['answer_list1']) ?>">
                                <input type="text" name="questions[<?php $this->escape($i); ?>][answer_list2]" class="ticket_id ticket_question_form" value="<?php $this->escape($question['answer_list2']) ?>">
                                <input type="text" name="questions[<?php $this->escape($i); ?>][answer_list3]" class="ticket_id ticket_question_form" value="<?php $this->escape($question['answer_list3']) ?>">

                                <label for="answer">答え</label>
                                <input type="text" id="answer" name="questions[<?php $this->escape($i); ?>][answer]" class="ticket_id ticket_question_form" value="<?php $this->escape($question['answer']) ?>">
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="flex">
                        <!-- 編集ボタン -->
                        <div class="ticketid-form__area ticketid-form__area--right">
                            <input type="submit" class="submit" name="edit" value="編集する">
                        </div>

                        <!-- 編集ボタン -->
                        <div class="ticketid-form__area ticketid-form__area--right">
                            <input type="submit" class="submit" name="delete" value="削除する">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>

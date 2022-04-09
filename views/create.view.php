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
                チケットを作る！
            </h1>

            <div class="ticketid-form">
                <h2>チケットをつくろう</h2>

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
                    <div class="ticketid-form__area">
                        <label for="ticket_img">チケット画像</label>
                        <input type="file" id="ticket_img" name="ticket_img">
                    </div>

                    <!-- コメント -->
                    <div class="ticketid-form__area">
                        <label for="ticket_comment">チケットにつけるコメント</label>
                        <input type="text" id="ticket_comment" name="ticket_comment" class="ticket_id" placeholder="fanrgargjaf">
                    </div>

                    <!-- クイズ作成 -->
                    <h2>クイズを作成</h2>
                    <div class="ticketid-form__area ticketid-form__area--question">
                        <label for="subject">クイズ１</label>
                        <input type="text" id="subject" name="questions[0][subject]" class="ticket_id ticket_question_form" placeholder="悠斗の誕生日は？">

                        <label for="answer_list1">答え選択肢</label>
                        <input type="text" name="questions[0][answer_list1]" class="ticket_id ticket_question_form" placeholder="3月11日">
                        <input type="text" name="questions[0][answer_list2]" class="ticket_id ticket_question_form" placeholder="5月19日">
                        <input type="text" name="questions[0][answer_list3]" class="ticket_id ticket_question_form" placeholder="8月20日">

                        <label for="answer">答え</label>
                        <input type="text" id="answer" name="questions[0][answer]" class="ticket_id ticket_question_form" placeholder="5月19日">
                    </div>


                    <div class="ticketid-form__area ticketid-form__area--question">
                        <label for="subject">クイズ2</label>
                        <input type="text" id="subject" name="questions[1][subject]" class="ticket_id ticket_question_form" placeholder="芽衣の誕生日は？">

                        <label for="answer_list2">答え選択肢</label>
                        <input type="text" name="questions[1][answer_list1]" class="ticket_id ticket_question_form" placeholder="2月13日">
                        <input type="text" name="questions[1][answer_list2]" class="ticket_id ticket_question_form" placeholder="5月19日">
                        <input type="text" name="questions[1][answer_list3]" class="ticket_id ticket_question_form" placeholder="8月20日">

                        <label for="answer">答え</label>
                        <input type="text" id="answer" name="questions[1][answer]" class="ticket_id ticket_question_form" placeholder="2月13日">
                    </div>

                    <div class="ticketid-form__area ticketid-form__area--question">
                        <label for="subject">クイズ3</label>
                        <input type="text" id="subject" name="questions[2][subject]" class="ticket_id ticket_question_form" placeholder="好きな食べ物は？">

                        <label for="answer_list2">答え選択肢</label>
                        <input type="text" name="questions[2][answer_list1]" class="ticket_id ticket_question_form" placeholder="ラーメン">
                        <input type="text" name="questions[2][answer_list2]" class="ticket_id ticket_question_form" placeholder="そば">
                        <input type="text" name="questions[2][answer_list3]" class="ticket_id ticket_question_form" placeholder="うどん">

                        <label for="answer">答え</label>
                        <input type="text" id="answer" name="questions[2][answer]" class="ticket_id ticket_question_form" placeholder="ラーメン">
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

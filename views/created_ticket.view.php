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

        <h1 class="title"><i class="fas fa-gift"></i>ticket for you from yuto</h1>
        <div class="ticket-img fadeIn">
            <img src="./images/gift_img2.png" alt="チケット画像">
        </div>
        <p class="info">この画像を保存して<br>当日はこのチケットを見せてね！！</p>
        <a href="#" class="ticket-link ticket-link--store">画像保存</a>
        <a href="/" class="ticket-link">Home</a>
    </div>
</body>

</html>

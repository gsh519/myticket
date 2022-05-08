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
        <h1 class="title"><i class="fas fa-gift"></i>ticket for you</h1>
        <div class="ticket-img fadeIn">
            <img src="<?php $this->escape($this->ticket['image_path']); ?>" alt="チケット画像">
        </div>
        <p class="ticket-comment"><?php $this->escape($this->ticket['ticket_comment']); ?></p>
        <p class="info">画像を長押しして保存できるよ！</p>
        <!-- <a href="../modules/download.php" class="ticket-link ticket-link--store">画像保存</a> -->
        <!-- <form action="" method="post">
            <button type="submit" name="download" value="download" class="ticket-link ticket-link--store">画像保存</button>
        </form> -->
        <a href="/" class="ticket-link">Home</a>
    </div>
</body>

</html>

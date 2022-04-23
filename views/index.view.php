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
    <script src="./js/script.js" defer></script>
</head>

<body>
    <div class="hero">
        <div class="wrapper">
            <div class="logo"><a href="./">myticket</a></div>
            <h1 class="hero__ttl"></h1>

            <!-- 成功メッセージ表示 -->
            <?php if (!empty($_SESSION['msg'])) : ?>
                <p class="message"><?php $this->escape($_SESSION['msg']); ?></p>
                <?php unset($_SESSION['msg']); ?>
            <?php endif; ?>

            <div class="hero__link">
                <div class="item">
                    <a href="./login.php">
                        <i class="fas fa-hand-holding-heart"></i>
                        チケットをわたす
                    </a>
                </div>
                <div class="item">
                    <a href="./ticketid_form.php">
                        <i class="fas fa-gift"></i>
                        チケットをもらう
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自分チケット</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.min.css">

    <script src="../js/script.js" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>

<body>
    <div class="wrapper ticket-frame">
        <div class="logo logo--get"><a href="./">myticket</a></div>
        <h1 class="title"><i class="fas fa-gift"></i>チケット一覧</h1>
        <div>
            <!-- 成功メッセージ表示 -->
            <?php if (isset($_SESSION['msg'])) : ?>
                <p class="message"><?php $this->escape($_SESSION['msg']); ?></p>
                <?php unset($_SESSION['msg']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['login_success'])) : ?>
                <p class="message"><?php $this->escape($_SESSION['login_success']); ?></p>
                <?php unset($_SESSION['login_success']); ?>
            <?php endif; ?>

            <ul class="ticket-tab">
                <li class="tab is-active">あげたチケット</li>
                <li class="tab">もらったチケット</li>
            </ul>
            <div class="ticket-area is-show">
                <?php if (!empty($this->tickets)) : ?>
                    <ul class="ticket-list ticket-list--create">
                        <?php foreach ($this->tickets as $ticket) : ?>
                            <li>
                                <img src="<?php $this->escape($ticket['image_path']); ?>" alt="">
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>あげたチケットがありません!</p>
                <?php endif; ?>
            </div>

            <div class="ticket-area">
                <ul class="ticket-list ticket-list--get">
                    <li>
                        <img src="https://placehold.jp/260x150.png" alt="">
                    </li>

                    <li>
                        <img src="https://placehold.jp/260x150.png" alt="">
                    </li>

                    <li>
                        <img src="https://placehold.jp/260x150.png" alt="">
                    </li>

                    <li>
                        <img src="https://placehold.jp/260x150.png" alt="">
                    </li>

                    <li>
                        <img src="https://placehold.jp/260x150.png" alt="">
                    </li>

                    <li>
                        <img src="https://placehold.jp/260x150.png" alt="">
                    </li>
                </ul>
            </div>
        </div>

        <div class="btn-wrapper">
            <a href="../create.php" class="btn">チケットを作成</a>
            <a href="/" class="ticket-link">Home</a>
        </div>
    </div>
</body>

</html>

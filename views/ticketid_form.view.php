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
                チケットをもらう
            </h1>

            <div class="ticketid-form">
                <h2>チケットIDを入力してね！</h2>

                <ul>
                    <?php foreach ($this->errors as $error) : ?>
                        <li><?php $this->escape($error); ?></li>
                    <?php endforeach; ?>
                </ul>

                <form action="" method="post">
                    <div class="ticketid-form__area">
                        <label for="ticket_key">チケットID</label>
                        <input type="text" id="ticket_key" name="ticket_key" class="ticket_id" placeholder="fanrgargjaf">
                    </div>
                    <div class="ticketid-form__area ticketid-form__area--right">
                        <input type="submit" class="submit" name="submit" value="送信">
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
